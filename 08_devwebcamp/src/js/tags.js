(function() {

    const tagsInput = document.querySelector('#tags_input')

    if(tagsInput) {

        let tags = [];

        // Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag)

        function guardarTag(e) {
            if(e.keyCode === 44) {
                if(e.target.value.trim() === '' || e.target.value < 1) { 
                    return
                }
                e.preventDefault();
                tags = [...tags, e.target.value.trim()];
                tagsInput.value = '';
                console.log(tags);
            }
        }
    }

})();