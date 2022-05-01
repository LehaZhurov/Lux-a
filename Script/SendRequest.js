function SendRequest(method,url,body = null){
	Ajax = true;
	return new Promise ((resolve,reject)=>{
		const xhr = new XMLHttpRequest();
		xhr.open(method,url,true)
		xhr.responseType = 'json';
		xhr.withCredentials = true;
		if(xhr.readyState == 0){
			console.log(0);
		}
		if(xhr.readyState == 1){
			console.log(1);
		}
		if(xhr.readyState == 3){
			console.log(3);
		}
		if(xhr.readyState == 4){
			console.log(4);
		}

		xhr.onload = () =>{
			if(xhr.status >= 400){
				reject(xhr.response);
			}else{
				resolve(xhr.response);
				// let mather_block = document.querySelector('#manga-spisok').innerHTML = " ";
			}
		}
		xhr.onerror = () =>{
			reject(xhr.response);
		}
		xhr.send(body);
	});
}
//Функции ссоздания и получени куки
function setCookie(name,value,days) {    var expires = "";    if (days) {        var date = new Date();        date.setTime(date.getTime() + (days*24*60*60*1000));        expires = "; expires=" + date.toUTCString();    }    document.cookie = name + "=" + (value || "")  + expires + "; path=/";}
function makeid(length) {    var result           = '';    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';    var charactersLength = characters.length;    for ( var i = 0; i < length; i++ ) {      result += characters.charAt(Math.floor(Math.random() * charactersLength));   }   return result;}
function getCookie(name) {    var nameEQ = name + "=";    var ca = document.cookie.split(';');    for(var i=0;i < ca.length;i++) {        var c = ca[i];        while (c.charAt(0)==' ') c = c.substring(1,c.length);        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);    }    return null;}


// console.log(getCookie('id'))
if(getCookie('id')){
	setCookie('id',getCookie('id'),365)
}else{
	setCookie('id',makeid(16),365);
}
//Функция получения и создания куки