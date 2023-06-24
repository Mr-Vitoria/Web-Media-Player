var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);

var inpDuration=document.querySelector('#InputDuration');
inpDuration.addEventListener('change',()=>{

    if(/^([0-9][0-9]:[0-9][0-9])$/.test(inpDuration.value))
    {
        document.querySelector('#submitBtn').disabled=false;
    }
    else{
        document.querySelector('#submitBtn').disabled=true;
    }
})


document.querySelectorAll('input[type=radio][name=r1]').forEach(inp=>inp.addEventListener('change' ,function() {
    if (this.value == 'text') {
        document.querySelector('#InputTextDiv').style.display="block";
        document.querySelector('#InputFileDiv').style.display="none";
        document.querySelector('#formFile').value="";
    }
    else if (this.value == 'file') {
        document.querySelector('#InputTextDiv').style.display="none";
        document.querySelector('#InputFileDiv').style.display="block";
    }
}));