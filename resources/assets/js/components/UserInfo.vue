<template>
    <div>
<div class="media">
    <a :href="user.url" class="pr-2">
        <img :src="user.avatar">
    </a>
    <div class="media-body mt-1">
        <a :href="user.url">{{user.name}}</a>
    </div>
</div>
<span class="text-muted  mt-2">  {{postDate}} </span>
    </div>
</template>
<script>
export default {
    props:['model','label'],
    computed: {
        postDate(){
            return this.label + " " + this.model.created_date;
        }
    },
    data(){
        return{
            user: this.model.user
        }
    }
    
}
</script>