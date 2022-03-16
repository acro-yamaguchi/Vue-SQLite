<template>
    <div class="login">
        <v-container fluid>
            <v-row justify='center'>
                <v-col cols='4'>ユーザーID</v-col>
                <v-col cols='6'>
                    <v-text-field
                    v-model="userId"
                    outlined
                    dense
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify='center'>
                <v-col cols='4'>Password</v-col>
                <v-col cols='6'>
                    <v-text-field
                    v-model="pass"
                    outlined
                    dense
                    type='password'
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify='center'>
                <v-btn @click="submit">
                    送信
                </v-btn>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from "axios"
export default {
    data() {
        return {
            userId: '',
            pass: ''
        }
    },
    methods:{
        submit(){
            try{
                axios.post('./api/session.php', {
                  userId: this.userId,
                  pass: this.pass
                })
                .then((response) => {
                    console.log(response.data)
                })
            }
            catch{
                alert('DB送信: 接続エラー')
            }
        }
    }
}
</script>