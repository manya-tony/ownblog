<template>
    <div>
        <div class="container">
            <!-- カテゴリ一覧 -->
            <div class="categoryList">
                <ul class="categoryList-item">
                    <li @click="dataClear" class="categoryList-itemLink">すべて</li>
                    <template v-if="categories.length">
                        <li v-for="category in categories" :key="category.id" @click="setSelectCategory(category.id)" class="categoryList-itemLink">{{ category.category_name }}</li>
                    </template>
                </ul>
                <a class="categoryList-link" href="/ownblog/category/create">カテゴリ編集</a>
            </div>
        </div>
        <div class="container_s">
            <!-- 記事一覧 -->
            <template v-if="matched.length">
                <ul class="articleList">
                    <li v-for="article in matched" :key="article.id" class="articleList-item">
                        <div class="articleList-item_text">
                            <h1 class="articleList-item_title"><a :href="'/ownblog/art/'+article.id">{{ article.title }}</a></h1>
                            <p class="articleList-item_day">
                                {{ article.updated_at }}
                                <span v-if="article.category" class="articleList-item_category">
                                    {{ article.category.category_name }}
                                </span>
                            </p>
                        </div>
                        <a class="articleList-item_img" :href="'/ownblog/art/'+article.id">
                            <img v-if="article.image" :src="'/ownblog/storage/app/public/images/'+article.image" :alt="article.title" />
                            <img v-else src="/ownblog/images/sample.png" :alt="article.title" />
                        </a>
                    </li>
                </ul>
            </template>
            <template v-else>
                <p>まだ記事はありません</p>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['categories', 'articles'],
        data () {
            return {
                condition: '',
                selectCategory: ''
            }
        },
        computed: {
            matched () {
                //conditionの値が変更されると自動的に呼び出される
                return this.articles.filter(function (element) {
                    //タイトルにcondionの値を含むものでフィルタ
                    return !this.selectCategory || element.category_id === this.selectCategory
                }, this)
            }
        },
        methods: {
            dataClear () {
                this.condition = ''
                this.selectCategory = ''
            },
            setSelectCategory (key) {
                this.selectCategory = key
            }
        }
    }
</script>
