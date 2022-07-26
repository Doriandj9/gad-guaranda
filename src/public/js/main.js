(function(){
    const eye = document.querySelectorAll('#eye');
    if(!eye && eye.length === 0) return;
    eye.forEach( e => {
        e.addEventListener('click',convert);
    })

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

(function(){
    const preview = document.getElementById('preview');
    if(!preview) return;
    const imput = document.getElementById('img-logo');

    imput.onchange = (e) => {
        const file = e.target.files[0];
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.addEventListener('load' ,(e) => {
                const url = fileReader.result;

                let html = `
                    <h3> El logo actual se remplazara por la siguiente imagen selecionada </h3>
                    <img src="${url}">
                `;
                preview.innerHTML = html;
        })
    }
})();