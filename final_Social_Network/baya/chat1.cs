using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Soc_net
{
    #region Chat
    public class Chat
    {
        #region Member Variables
        protected int _id;
        protected string _message;
        protected string _to;
        protected string _from;
        #endregion
        #region Constructors
        public Chat() { }
        public Chat(string message, string to, string from)
        {
            this._message=message;
            this._to=to;
            this._from=from;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Message
        {
            get {return _message;}
            set {_message=value;}
        }
        public virtual string To
        {
            get {return _to;}
            set {_to=value;}
        }
        public virtual string From
        {
            get {return _from;}
            set {_from=value;}
        }
        #endregion
    }
    #endregion
}