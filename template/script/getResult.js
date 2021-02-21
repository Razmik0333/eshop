export async function getResult(url, data = null) {
	let results;
  	if(data == null){
		results =await fetch(url)
		.then(res => {
		  if(res.ok){
			  return  res.json();
		  }else{
			  throw new Error(`не получилос получит ответ. Код ошибки:${res.status}`);
		  }
	  })
	}
	else{
		results = await fetch(url, {
			method: 'POST',
			body: data
		}).then(res => {
			return res.json()
		});
		//results = await response.json();
	}
	return results;
}