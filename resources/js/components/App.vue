<script>
export default {
    data() { return { article: null } },
    created() {
        window.Echo.channel('test').listen('NewArticleEvent', (article) => {
            console.log(article);
            this.article = article.article;
        })
    }
}
</script>

<template>
    <div v-if="article" role="alert">
        <p><span class="label"> Добавлена новая статья</span> <a :href="`/article/${article.id}/`">{{ article.name }}</a></p>
        <p><span class="label">Дата:</span> {{ article.date }}</p>
    </div>
    <!-- <p class="no-data" v-else>Нет данных о статье</p> -->
</template>