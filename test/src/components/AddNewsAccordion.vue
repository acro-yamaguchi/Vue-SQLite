<template>
    <v-expansion-panels>
        <v-expansion-panel>
            <v-expansion-panel-header color="#b5e61d">
                お知らせ追加
            </v-expansion-panel-header>
            <v-expansion-panel-content>
                <v-container class="mt-5">
                    <v-row justify='center'>
                        <v-col cols="12">
                            <v-form ref="form">
                                <v-row justify="center">
                                    <v-col cols="3" class="text-body-2 text-center cell_top remove_border-right">
                                        見出し<br>
                                        <span style="color: red; font-size: 12px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell_top">
                                        <v-text-field
                                        outlined
                                        dense
                                        v-model="title"
                                        :rules="Rules"
                                        required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="3" class="text-body-2 text-center cell remove_border-right">
                                        概要<br>
                                        <span style="color: red; font-size: 12px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell">
                                        <v-text-field
                                        outlined
                                        dense
                                        v-model="summary"
                                        :rules="Rules"
                                        required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="3" class="text-body-2 text-center cell remove_border-right">
                                        内容<br>
                                        <span style="color: red; font-size: 12px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell">
                                        <v-text-field
                                        outlined
                                        dense
                                        v-model="content"
                                        :rules="Rules"
                                        required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="3" class="text-body-2 text-center cell remove_border-right">
                                        画像<br>
                                        <span style="color: red; font-size: 12px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell">
                                        <image-input v-model="image"/>
                                    </v-col>
                                    <v-col cols="3" class="text-body-2 text-center cell remove_border-right">
                                        プレビュー<br>
                                    </v-col>
                                    <v-col cols="7" class="cell">
                                        <img :src="image.src">
                                    </v-col>
                                </v-row>
                                <v-row justify="end" class="mt-6">
                                    <v-btn
                                        color="success"
                                        large
                                        @click="submit"
                                        :loading="loading"
                                    >登録</v-btn>
                                </v-row>
                            </v-form>
                        </v-col>
                    </v-row>
                </v-container>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>
</template>

<script>
import ImageInput from "../components/ImageInput.vue"
import axios from 'axios'

export default {
    components: {
        ImageInput
    },
    data() {
        return {
            title: '',
            summary: '',
            content: '',
            image: {},
            Rules: [
                v => !!v || '入力必須です',
            ],
            loading: false
        }
    },
    methods: {
        submit(){
            if(this.$refs.form.validate()){
                this.loading = true
                const img = this.image.src.replace(/^data:\w+\/\w+;base64,/, '')
                const fileExtension = this.image.src.toString().slice(this.image.src.indexOf('/') + 1, this.image.src.indexOf(';'))
                const date = new Date()
                const fileName = date.valueOf()
                const name = '' + fileName + '.' + fileExtension

                this.storeNews(img, name)
            }
        },
        storeImage(img, name){
            let data = {
                name: name,
                image: img
            }
            axios.post('./api/storeImage.php', data).then(() => {
                this.loading = false
            })
        },
        storeNews(img, name){
            const imageUrl = '../storage/' + name
            let data = {
                title: this.title,
                summary: this.summary,
                content: this.content,
                image: imageUrl
            }
            axios.post('./api/storeNews.php', data).then((response) => {
                if(response.data.result) {
                    this.storeImage(img, name)
                } else {
                    alert('DB接続エラー')
                }               
            })
        }
    }
}
</script>

<style scoped>
.cell {
  border: solid;
  border-top: none;
}

.cell_top {
  border: solid;
}

.remove_border-right {
  border-right: none;
}

img{
    width: 100%;
    height: 100%;
  object-fit: contain;
}

</style>