<template>
  <div class="contact">
    <v-container fluid>
      <v-row justify="center" class="mt-5">
        <v-col cols="12" class="text-h5 text-center">【お問い合わせフォーム】</v-col>
        <v-col cols="12" md="8" class="mb-6">
          <v-form ref="form">
            <v-row>
              <v-col cols="5" class="text-body-1 text-center cell_top cell_left">
                お名前<br>
                <span style="color: red; font-size: 16px;">※必須</span>
              </v-col>
              <v-col cols="7" class="cell_top">
                <v-text-field
                  v-model="name"
                  :rules="nameRules"
                  required
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="5" class="text-body-1 text-center cell cell_left">
                E-mail<br>
                <span style="color: red; font-size: 16px;">※必須</span>
              </v-col>
              <v-col cols="7" class="cell">
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  required
                  outlined
                  dense
                  type="email"
                ></v-text-field>
              </v-col>
              <v-col cols="5" class="text-body-1 text-center cell cell_left">
                お電話番号<br>
                <span style="color: red; font-size: 16px;">※必須(ハイフンなし、半角数字)</span>
              </v-col>
              <v-col cols="7" class="cell">
                <v-text-field
                  v-model="phone"
                  :rules="phoneRules"
                  required
                  outlined
                  dense
                  type="tel"
                ></v-text-field>
              </v-col>
              <v-col cols="5" class="text-body-1 text-center cell cell_left">
                カテゴリ<br>
                <span style="color: red; font-size: 16px;">※必須</span>
              </v-col>
              <v-col cols="7" class="cell">
                <v-select
                  outlined
                  v-model="category"
                  :items="items"
                  :rules="categoryRules"
                  dense
                  required
                ></v-select>
              </v-col>
              <v-col cols="5" class="text-body-1 text-center cell cell_left">
                件名
              </v-col>
              <v-col cols="7" class="cell">
                <v-text-field
                  v-model="title"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="5" class="text-body-1 text-center cell cell_left">
                お問い合わせ内容<br>
                <span style="color: red; font-size: 16px;">※必須</span>
              </v-col>
              <v-col cols="7" class="cell">
                <v-textarea
                  v-model="content"
                  :counter="500"
                  :rules="contentRules"
                  required
                  outlined
                  auto-grow
                ></v-textarea>
              </v-col>
            </v-row>
            <v-row justify="center" class="mt-6">
              <v-btn
                color="success"
                large
              >送信</v-btn>
            </v-row>
          </v-form>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      phone: null,
      category: '',
      items: ['お仕事', '求人', 'その他'],
      content: '',
      nameRules: [
        v => !!v || 'お名前の入力は必須です',
      ],
      emailRules: [
        v => !!v || 'メールアドレスの入力は必須です',
        v => /.+@.+\..+/.test(v) || '無効メールアドレスです',
      ],
      phoneRules: [
        v => !!v || 'お電話番号の入力は必須です',
        v => /^[0-9]+$/.test(v) || 'お電話番号は半角数字のみで入力して下さい'
      ],
      categoryRules: [
        v => !!v || 'カテゴリの選択は必須です',
      ],
      contentRules: [
        v => !!v || 'お問い合わせ内容の入力は必須です',
        v => v.length <= 500 || 'お問い合わせ内容は500文字までです。',
      ],
    }
  },
  created() {
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

.cell_left {
  border-right: none;
}
</style>