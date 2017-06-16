using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.Diagnostics;
using System.Configuration;
using MySql.Data.MySqlClient; 

namespace WindowsFormsApplication1
{
    public partial class Messenger : Form
    {
        public string ip, pc_number,  username, connectionString = ConfigurationManager.ConnectionStrings["mySql"].ConnectionString;
        MySqlConnection conn;
        private Timer timer1;

        public void InitTimer()
        {
            timer1 = new Timer();
            timer1.Tick += new EventHandler(timer1_Tick);
            timer1.Interval = 5000; // in miliseconds
            timer1.Start();
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            do_manual();
        }

        public void do_manual() {
            check_if_shutdown();
            update_database();
        }

        public Messenger()
        {
            InitializeComponent();
        }

        private void Messenger_Load(object sender, EventArgs e)
        {
           
            this.ip = check_ip();
            this.pc_number = ConfigurationManager.AppSettings["pc_number"];    
            this.username = System.Environment.MachineName;
            do_manual();
            InitTimer();
            Hide();

        }
       
        public String check_ip() {
          
             if (!System.Net.NetworkInformation.NetworkInterface.GetIsNetworkAvailable())
             {
                return null;
             }

             var host = Dns.GetHostEntry(Dns.GetHostName());
             foreach (var ip in host.AddressList)
             {
                 if (ip.AddressFamily == System.Net.Sockets.AddressFamily.InterNetwork)
                 {
                     return ip.ToString();
                 }
             }
             throw new Exception("Local IP Address Not Found!");
        }

        public void update_database() {
                Process[] processes = Process.GetProcesses();
                List<string> process = new List<string>(new string[] { });
                foreach (Process p in processes)
                    if (!String.IsNullOrEmpty(p.MainWindowTitle)) process.Add(p.MainWindowTitle);
                try
                {
                    conn = new MySql.Data.MySqlClient.MySqlConnection();
                    conn.ConnectionString = connectionString;
                    conn.Open();
                    MySqlCommand comm = conn.CreateCommand();
                    comm.CommandText = " INSERT INTO ip_monitoring (ip, username,  application_processing, date_added, status, pc_number ) VALUES ( ?ip , ?username , ?application_processing, ?date_added, 1 , ?pc_number) ON DUPLICATE KEY UPDATE username=?username , application_processing = ?application_processing, date_added = ?date_added, status = 1";
                    comm.Parameters.Add("?ip", this.ip);
                    comm.Parameters.Add("?username", this.username);
                    comm.Parameters.Add("?application_processing", string.Join(",", process.ToArray()));
                    comm.Parameters.Add("?date_added", DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss.fffffff"));
                    comm.Parameters.Add("?pc_number", this.pc_number);
                    comm.ExecuteNonQuery();
                    conn.Close();
                }
                catch (MySql.Data.MySqlClient.MySqlException ex)
                {
                    MessageBox.Show(ex.ToString());
                }
        }

        public void check_if_shutdown() {
            string local_ip = null;
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = connectionString;
                conn.Open();
                MySqlCommand comm = conn.CreateCommand();
                comm.CommandText = "SELECT * from ip_monitoring where ip = ?ip AND pc_number = ?pc_number AND shutdown = 1";
                comm.Parameters.Add("?ip", this.ip);
                comm.Parameters.Add("?pc_number", this.pc_number);
                MySqlDataReader reader = comm.ExecuteReader();
                while (reader.Read())
                {
                    local_ip = this.ip;
                   
                }
                reader.Dispose();
                conn.Close();
                if (local_ip != null)
                {
                    MessageBox.Show("Your Computer has been shutdown by your Instructor");
                    conn.Open();
                    comm.CommandText = " UPDATE ip_monitoring set shutdown = 0 where ip = ?ip_address and pc_number = ?pc";
                    comm.Parameters.Add("?ip_address", local_ip);
                    comm.Parameters.Add("?pc", this.pc_number);
                    comm.ExecuteNonQuery();
                    conn.Close();
                    /*var psi = new ProcessStartInfo("shutdown", "/s /t 0");
                    psi.CreateNoWindow = true;
                    psi.UseShellExecute = false;
                    Process.Start(psi);*/
                }
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
               Console.WriteLine(ex.ToString());
               MessageBox.Show(ex.ToString());
            }
        }

       

    }
}
