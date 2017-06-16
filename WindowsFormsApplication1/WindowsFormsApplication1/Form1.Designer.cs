namespace WindowsFormsApplication1
{
    partial class Messenger
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.replyButton = new System.Windows.Forms.Button();
            this.reply = new System.Windows.Forms.RichTextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.nameMessenger = new System.Windows.Forms.Label();
            this.adminMessage = new System.Windows.Forms.RichTextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // replyButton
            // 
            this.replyButton.Location = new System.Drawing.Point(456, 369);
            this.replyButton.Name = "replyButton";
            this.replyButton.Size = new System.Drawing.Size(75, 48);
            this.replyButton.TabIndex = 0;
            this.replyButton.Text = "Reply";
            this.replyButton.UseVisualStyleBackColor = true;
            this.replyButton.Click += new System.EventHandler(this.replyButton_Click);
            // 
            // reply
            // 
            this.reply.Location = new System.Drawing.Point(63, 188);
            this.reply.Name = "reply";
            this.reply.Size = new System.Drawing.Size(468, 177);
            this.reply.TabIndex = 1;
            this.reply.Text = "";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(60, 31);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(41, 13);
            this.label1.TabIndex = 2;
            this.label1.Text = "FROM:";
            // 
            // nameMessenger
            // 
            this.nameMessenger.AutoSize = true;
            this.nameMessenger.Location = new System.Drawing.Point(107, 31);
            this.nameMessenger.Name = "nameMessenger";
            this.nameMessenger.Size = new System.Drawing.Size(0, 13);
            this.nameMessenger.TabIndex = 3;
            // 
            // adminMessage
            // 
            this.adminMessage.Location = new System.Drawing.Point(63, 47);
            this.adminMessage.Name = "adminMessage";
            this.adminMessage.Size = new System.Drawing.Size(468, 96);
            this.adminMessage.TabIndex = 4;
            this.adminMessage.Text = "";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(60, 161);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(62, 13);
            this.label2.TabIndex = 5;
            this.label2.Text = "Your Reply:";
            // 
            // Messenger
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(591, 447);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.adminMessage);
            this.Controls.Add(this.nameMessenger);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.reply);
            this.Controls.Add(this.replyButton);
            this.Name = "Messenger";
            this.Text = "Messenger";
            this.Load += new System.EventHandler(this.Messenger_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button replyButton;
        private System.Windows.Forms.RichTextBox reply;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label nameMessenger;
        private System.Windows.Forms.RichTextBox adminMessage;
        private System.Windows.Forms.Label label2;
    }
}

