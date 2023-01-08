using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using System.Net.Mail;
using WcfUsuarioNJoy.DAO;
namespace WcfUsuarioNJoy
{
    // OBSERVAÇÃO: Você pode usar o comando "Renomear" no menu "Refatorar" para alterar o nome da classe "Service1" no arquivo de código, svc e configuração ao mesmo tempo.
    // OBSERVAÇÃO: Para iniciar o cliente de teste do WCF para testar esse serviço, selecione Service1.svc ou Service1.svc.cs no Gerenciador de Soluções e inicie a depuração.
    public class Service1 : IService1
    {
        private DAO.UsuarioDAO usuarioDAO = new UsuarioDAO();
        public Boolean InserirUsuario(int id_avatar, int id_capa, String email, String usuario, String senha, int cep, int tipo_id, int logado, int moeda, String uf, int pontos, String cidade)
        {
            usuarioDAO.InserirDados( id_avatar,  id_capa,  email,  usuario,  senha,  cep, tipo_id, logado, moeda, uf, pontos, cidade);
            return true;
        }

        public Boolean EnviarEmail(string email)
        {
            string codigo = usuarioDAO.GravarCodigo(email);
            System.Net.Mail.SmtpClient client = new System.Net.Mail.SmtpClient();
            client.Host = "smtp.gmail.com";
                client.EnableSsl = true;
                client.Credentials = new System.Net.NetworkCredential("njoyequipe@gmail.com","njoy2318");
                MailMessage mail = new MailMessage();
                mail.Sender = new System.Net.Mail.MailAddress("njoyequipe@gmail.com", "NJoy Equipe");
                mail.From = new MailAddress("njoyequipe@gmail.com", "NJoy Equipe");
                mail.To.Add(new MailAddress(email, email));
                mail.Subject = "Verificar cadastro";
                string link= "http://njoy.kinghost.net/site.html";
                mail.Body = "Seu código é:"+codigo+"<br> Confirme seu email aqui: <a href="+link+"> CONFIRMAR </a> ";
                mail.IsBodyHtml = true;
                mail.Priority = MailPriority.High;
                bool foi=true;
                try
                {
                    client.Send(mail);
                     foi = true;
                return foi;
                }
                catch (System.Exception erro)
                {
                string msg = erro.Message;
                foi = false;
                return foi;
                }
                finally
                {
                    mail = null;
                }

            }
        }
    }
