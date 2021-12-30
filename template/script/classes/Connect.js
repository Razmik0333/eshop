class Connect {

    constructor(url){
        this.url = url;
       
    }
    static instance = this;
    static exists = true;
    async fetchPost(data)  {
        let result;
        result = await fetch(this.url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data),
        })
        .then(res =>  res.json())
        .catch(err =>{            
            throw new Error(`не получилос получит ответ ${err}.)`);//` Код ошибки:${res.status}`);
        })
        return result;
    }
    async fetchGet() {
       let result = await fetch(this.url)
        .then(res =>  res.json())
        .catch(err =>{            
            throw new Error(`не получилос получит ответ ${err}.)`)//` Код ошибки:${res.status}`);
        })
        return result;
    }
    getInstance(){
        if (!Connect.exists) {
            return Connect.instance = this;
        }
        return Connect.instance;
    }
    
}

export {Connect}

