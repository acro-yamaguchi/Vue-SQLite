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
            image: {}
        }
    },
    methods: {
        submit(){
            this.storeImage()
        },
        storeImage(){
            let img = this.image.src.replace(/^data:\w+\/\w+;base64,/, '')
            let data = {
                name: 'test.jpg',
                image: img
            }
            axios.post('./api/storeImage.php', data)
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