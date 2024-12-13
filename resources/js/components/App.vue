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
    <div class="alert alert-primary text-center" v-if="article" role="alert">
        <p><span class="label"> Добавлена новая статья</span> <a :href="`/article/${article.id}/`">{{ article.name }}</a></p>
        <p><span class="label">Дата:</span> {{ article.date }}</p>
    </div>
    <!-- <p class="no-data" v-else>Нет данных о статье</p> -->
</template>
<style scoped>
.article-container {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    max-width: 400px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    margin: 16px auto;
}
.article-container p {
    margin: 8px 0;
    line-height: 1.4;
}
.label {
    font-weight: bold;
    color: #333;
}
.no-data {
    text-align: center;
    font-size: 1.2em;
    color: #666;
    margin: 16px auto;
    font-family: Arial, sans-serif;
}
</style>