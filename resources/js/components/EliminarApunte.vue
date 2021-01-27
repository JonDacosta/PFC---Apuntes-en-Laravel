<template>
    <input 
        type="submit" 
        class="btn btn-danger d-block w-100 mb-2" 
        value="Eliminar x"
        @click="eliminarApunte"    
    >
</template>

<script>
export default {
    props: ['apunteId'],
    methods: {
        eliminarApunte(){
            this.$swal({
                    title: '¿Estas seguro de eliminar este apunte?',
                    text: 'No hay vuelta atrás!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {

                    const params = {
                        id: this.apunteId
                    }
                    //Enviar la petición al servidor
                    axios.post(`/apuntes/${this.apunteId}`, {params, _method: 'delete'})
                        .then(respuesta => {
                            this.$swal({
                                title: 'Apunte eliminado',
                                text: 'Se eliminó el apunte',
                                icon: 'success'
                            });

                            //Eliminar apunte del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        })
                        .catch(error => {
                            console.log(error)
                        })
                    
                    
                }
            })
        }
    }
}
</script>