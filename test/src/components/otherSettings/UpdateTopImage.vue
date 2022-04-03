<template>
    <div class="updateTopImage">
        <v-row justify="center">
            <v-dialog
                v-model="dialog"
                :fullscreen="$vuetify.breakpoint.mobile"
                hide-overlay
                transition="dialog-bottom-transition"
                max-width="800"    
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color='success'
                        dark
                        block
                        v-bind="attrs"
                        v-on="on"
                    >
                        {{dialog_title}}
                    </v-btn>
                </template>
                <v-card>
                    <v-toolbar
                        dark
                        color="#b5e61d"
                    >
                        <v-btn icon dark @click="dialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>{{dialog_title}}</v-toolbar-title>                        
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn
                            dark
                            @click="submit"
                            :loading="loading"
                            >
                            登録
                            </v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-container>
                        <v-row justify="center">
                            <v-col cols="12" class="text-center">新しい画像</v-col>
                            <v-col cols="12"><image-input v-model="image"/></v-col>
                            <v-col cols="12" class="text-center">プレビュー</v-col>
                            <v-col cols="12">
                                <img :src="image.src == null ? require('@/assets/Top.png') : image.src">
                            </v-col>
                            <v-col cols="8">
                                <v-btn
                                    dark
                                    block
                                    color="success"
                                    @click="clear"
                                >現在の画像をクリア</v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
</template>

<script>
import ImageInput from "../../components/ImageInput.vue"
import axios from 'axios'

export default {
    components: {
        ImageInput
    },
  name: 'UpdateTopImage',

  data: () => ({
    dialog: false,
    dialog_title: "トップ画像の編集",
    image: {},
    loading: false
  }),
  methods: {
        submit() {
            this.loading = true
            const img = this.image.src.replace(/^data:\w+\/\w+;base64,/, '')
            const fileExtension = this.image.src.toString().slice(this.image.src.indexOf('/') + 1, this.image.src.indexOf(';'))
            const date = new Date()
            const fileName = date.valueOf()
            const name = 'Top_' + fileName + '.' + fileExtension

            this.storeNews(name, img)
        },
        storeImage(img, name){
            let data = {
                name: name,
                image: img
            }
            axios.post('./api/storeImage.php', data).then(() => {
                this.loading = false
                this.dialog = false
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
            axios.post('./api/updateTopImage.php', data).then((response) => {
                if(response.data.result) {
                    this.storeImage(img, name)
                } else {
                    alert('DB接続エラー')
                }               
            })
        },
        clear() {
            this.image = {}
        }
        
  }
  
};
</script>

<style scoped>
img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}
</style>