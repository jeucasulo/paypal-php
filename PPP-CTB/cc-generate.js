function generateCC(){
    let cc = Math.floor(Math.random() * 9);
	let myArray = ['4799108266367836','4867474260376562','4290274793437551','4431609966844366','4121125264725327','5206920395319221','5558516155761455','5357039238638478','5452153329399926','5224731104766752'];
    let newCC = myArray[cc]; 
    let lastCC = document.getElementById('lastCC').textContent;
    
    if(newCC == lastCC){
        newCC = myArray[cc+1];
    } else{
		//console.log("Valores diferentes\nlast: "+lastCC+"\nnew: "+newCC);
    }
    document.getElementById('lastCC').innerHTML = newCC;
}
