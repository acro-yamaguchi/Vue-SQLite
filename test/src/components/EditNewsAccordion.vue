<template>
    <v-expansion-panels>
        <v-expansion-panel>
            <v-expansion-panel-header color="#b5e61d">
                お知らせ編集
            </v-expansion-panel-header>
            <v-expansion-panel-content class="px-0 py-3">
                <v-container class="mt-5 pa-0">
                    <v-row justify='center'>
                       <v-data-table
                        :headers='headers'
                        :items='news'
                        hide-default-footer
                        :items-per-page='-1'
                        style="border: thin solid rgba(0, 0, 0, .12);"
                        >
                            <template v-slot:[`item.actions`]="{ item }">
                                <v-btn color='primary' @click.stop="editItem(item)">編集</v-btn>
                            </template>
                            <template v-slot:[`item.is_published`]="{ item }">
                                <v-simple-checkbox
                                 v-model="item.publish_order"
                                 disabled
                                ></v-simple-checkbox>
                            </template>
                        </v-data-table>
                    </v-row>
                </v-container>
                <v-dialog v-model="dialog" max-width="960">
                    <v-card>
                        <v-toolbar
                            dark
                            color="#b5e61d"
                        >
                            <v-btn icon dark @click.stop="dialog = false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                            <v-toolbar-title>{{dialog_title}}</v-toolbar-title>                        
                        </v-toolbar>
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
                                                v-model="editedItem.title"
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
                                                v-model="editedItem.summary"
                                                :rules="Rules"
                                                required
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="3" class="text-body-2 text-center cell remove_border-right">
                                                内容<br>
                                                <span style="color: red; font-size: 12px;">※必須</span>
                                            </v-col>
                                            <v-col cols="7" class="cell">
                                                <v-textarea
                                                outlined
                                                auto-grow
                                                v-model="editedItem.content"
                                                :rules="Rules"
                                                required
                                                ></v-textarea>
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
                                                <img class="dialog_img" :src="image.src == null ? editedItem.image : image.src">
                                            </v-col>
                                            <v-col cols="3" class="text-body-2 text-center cell remove_border-right">
                                                削除
                                            </v-col>
                                            <v-col cols="7" class="cell">
                                                <v-btn dark block color='error' @click.stop="remove_dialog = true">
                                                    このお知らせを削除する
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                        <v-row justify="end" class="mt-6">
                                            <v-btn
                                                color="success"
                                                large
                                                @click="submit"
                                                :loading="loading"
                                            >保存</v-btn>
                                        </v-row>
                                    </v-form>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-dialog>
                <v-dialog width="300" v-model="remove_dialog">
                    <v-card>
                        <v-card-title class="text-center">本当に削除しますか？</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn text color="#b5e61d" @click.stop="remove_dialog = false">
                                CANCEL
                            </v-btn>
                            <v-btn text color="#D33" @click.stop="remove">
                                OK
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
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
            news: [],
            headers: [
                {
                    text: 'ID',
                    sortable: true,
                    value: 'id',
                    width: '15%',
                    divider: true
                },
                { text: '見出し', sortable: false, value: 'title', width: '30%', divider: true },
                { text: '概要', sortable: false, value: 'summary', width: '30%', divider: true },
                { text: '公開中', sortable: true, value: 'is_published', width: '15%', divider: true, align: 'center' },
                { text: '編集', sortable: false, value: 'actions', width: '10%', divider: true, align: 'center' },
            ],
            editedItem: {
                id: null,
                title: '',
                summary: '',
                content: '',
                publish_order: null,
                image: '',
            },
            title: '',
            summary: '',
            content: '',
            image: {},
            Rules: [
                v => !!v || '入力必須です',
            ],
            loading: false,
            dialog: false,
            dialog_title: 'お知らせの編集',
            remove_dialog: false
        }
    },
    created() {
        axios.get('./api/getAllNews.php').then((response) => {
            this.news = response.data
            for(let i = 0; i < this.news.length; i++){
                this.news[i].publish_order = Boolean(this.news[i].publish_order) 
            }
        })
        console.log(this.image.src == null)
    },
    methods: {
        editItem(item){
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },
        remove() {
            axios.post('./api/removeNews.php', { data : this.editedItem.id }).then((response) => {
            if(response.data === 1){
                this.remove_dialog = false
                this.dialog = false
            } else {
                alert("削除に失敗しました")
                this.remove_dialog = false
            }
            this.news = this.news.filter(item => item.id !== this.editedItem.id)
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

.dialog_img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}
</style>