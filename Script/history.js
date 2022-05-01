

query = document.location.href
href  = query.split('/')[4] +"/"+query.split('/')[5]
function AppendInHistory() {
	 SendRequest('GET','/set_history/'+href)//Получени самого списка глав
    .then(data => console.log(data))
    .catch(err => console.log(err));
}