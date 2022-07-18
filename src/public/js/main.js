(function(){
    const eye = document.querySelector('#eye');
    if(!eye) return;
    eye.addEventListener('click',convert);

    function convert(e){
        e.preventDefault();
        let input = e.target.previousElementSibling;
        if(input.hasAttribute('text')){
            input.removeAttribute('text');
            input.type = 'password';
            e.target.parentNode.classList.add('raya');
        }else{
            input.setAttribute('text','');
            input.type = 'text';
            e.target.parentNode.classList.remove('raya');
        }
        
    }
})();
