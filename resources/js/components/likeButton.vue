<template>
    
    <div>
        <span class="like-btn" @click="likeApunte" :class="{ 'like-active' : isActive }"></span>
    

    <p>A {{ cantidadLikes }} le ha gustado este apunte </p>
</div>
</template>

<script>
export default {
    props: ['apunteId', 'like', 'likes'],
    data: function() {
        return{
            isActive: this.like,
            totalLikes: this.likes
        }
    },
    methods: {
        likeApunte(){
            axios.post('/apuntes/' + this.apunteId)
                .then(respuesta => {
                    if(respuesta.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }

                    this.isActive = !this.isActive
                })    
                .catch(error => {
                    if(error.response.status === 401) {
                        window.location = '/register';
                    }
                });
        }
    },
    computed:{
        cantidadLikes: function() {
            return this.totalLikes
        }
    }
}
</script>