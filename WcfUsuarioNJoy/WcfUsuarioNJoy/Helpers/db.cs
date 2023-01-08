using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Configuration;

namespace WcfUsuarioNJoy.Helpers
{
    class dbs
    {
        private String connectionString;

        public String getConnectionString()
        {
            connectionString = ConfigurationManager.ConnectionStrings["WcfUsuarioNJoy.Properties.Settings.crudConnectionString"].ConnectionString;
            return connectionString;
        }
    }
}
