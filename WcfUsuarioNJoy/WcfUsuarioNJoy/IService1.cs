using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace WcfUsuarioNJoy
{
    // OBSERVAÇÃO: Você pode usar o comando "Renomear" no menu "Refatorar" para alterar o nome da interface "IService1" no arquivo de código e configuração ao mesmo tempo.
    [DataContract] //Opcional com .NET 3.5 + SP1
    public class Usuario
    {
        [DataMember] //Opcional com .NET 3.5 + SP1
        public Boolean inseriu { get; set; }
    }


    [ServiceContract]
    public interface IService1
    {

        [OperationContract]
        Boolean InserirUsuario(int id_avatar, int id_capa, String email, String usuario, String senha, int cep, int tipo_id, int logado, int moeda, String uf, int pontos, String cidade);

        [OperationContract]
        Boolean EnviarEmail(string email);


        // TODO: Adicione suas operações de serviço aqui
    }


    // Use um contrato de dados como ilustrado no exemplo abaixo para adicionar tipos compostos a operações de serviço.
    
}
