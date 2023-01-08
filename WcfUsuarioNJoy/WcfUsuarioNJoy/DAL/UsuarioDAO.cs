using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using MySql.Data.MySqlClient;
namespace WcfUsuarioNJoy.DAO
{
    public class UsuarioDAO
    {
        private Helpers.dbs db = new Helpers.dbs();
        private MySqlConnection con =  new MySqlConnection();
        
        public void InserirDados(int id_avatar, int id_capa, String email, String usuario, String senha, int cep, int tipo_id, int logado, int moeda, String uf, int pontos, String cidade)
        {
            String query = "INSERT INTO usuario(id_usuario, id_avatar, id_capa, email, usuario, senha, cep, tipo_id, logado, moeda, uf, pontos, cidade) VALUES";
            query += "(DEFAULT, ?id_avatar, ?id_capa, ?email, ?usuario, ?senha, ?cep, ?tipo_id, ?logado, ?moeda, ?uf, ?pontos, ?cidade)";
            try
            {
                Conecta(true);
                MySqlCommand cmd = new MySqlCommand(query, con);
                cmd.Parameters.AddWithValue("?id_avatar", id_avatar);
                cmd.Parameters.AddWithValue("?id_capa", id_avatar);
                cmd.Parameters.AddWithValue("?email", email);
                cmd.Parameters.AddWithValue("?usuario", usuario);
                cmd.Parameters.AddWithValue("?senha", senha);
                cmd.Parameters.AddWithValue("?cep", cep);
                cmd.Parameters.AddWithValue("?tipo_id", tipo_id);
                cmd.Parameters.AddWithValue("?logado", logado);
                cmd.Parameters.AddWithValue("?moeda", moeda);
                cmd.Parameters.AddWithValue("?uf", uf);
                cmd.Parameters.AddWithValue("?pontos", pontos);
                cmd.Parameters.AddWithValue("?cidade", cidade);
                cmd.ExecuteNonQuery();
                cmd.Dispose();
            }
            finally
            {
                Conecta(false);
            }
        }
        public void Conecta(bool ligaDes)
        {
            con.Close();
            if(con.ConnectionString != db.getConnectionString())
                con.ConnectionString = db.getConnectionString();
            if (ligaDes)
                if(con.State != System.Data.ConnectionState.Open)
                    con.Open();
            if (!ligaDes)
                con.Close();
        }
        public string GravarCodigo(string email)
        {
            MySqlConnection con1 = new MySqlConnection();
            con1.ConnectionString = "server=mysql.njoy.kinghost.net;database=njoy;user id=njoy;password=njoy2318;sslmode=None";
            Random rcodigo = new Random();
            int codigo=rcodigo.Next(100000, 999999);
            string sql = "SELECT * FROM email WHERE codigo=" + codigo.ToString();
            String query = "INSERT INTO email(codigo, email) VALUES";
            query += "(?codigo, ?email)";
            try
            {
                MySqlDataReader reader;
                MySqlCommand cmd1 = new MySqlCommand(sql, con1);
                if (con1.State != System.Data.ConnectionState.Open)
                    con1.Open();
                reader = cmd1.ExecuteReader();
                do
                {
                    reader.Close();
                    codigo=rcodigo.Next(100000, 999999);
                    cmd1 = new MySqlCommand(sql, con1);
                    reader = cmd1.ExecuteReader();
                } while (reader.Read());
                    reader.Close();
                    MySqlCommand cmd = new MySqlCommand(query, con1);
                    cmd.Parameters.AddWithValue("?codigo", codigo.ToString());
                    cmd.Parameters.AddWithValue("?email", email);
                    cmd.ExecuteNonQuery();
                    cmd.Dispose();
                    return codigo.ToString();
            }
            catch
            {
                return GravarCodigo(email);
            }
            finally
            {
                con1.Close();
            }
        }
    }
}