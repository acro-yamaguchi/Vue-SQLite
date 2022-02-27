<template>
  <v-app>
    <v-app-bar
      app
      color="#b5e61d"
      prominent
      dense
      flat
    >
      <div class="d-flex align-center">
        <v-img
          alt="Happy Position Logo"
          contain
          src="@/assets/logo.png"
          height="96"
          max-width="96"
          transition="scale-transition"
        />
        <v-toolbar-title class="text-subtitle-1 text-md-h5">Happy Position ホームページ</v-toolbar-title>
      </div>
    </v-app-bar>

    <v-main>
      <v-tabs
        background-color="#b5e61d"
        grow
        color="basil"
      >
        <v-tab
          v-for="tab in tabs"
          :key="tab"
          :to="tab.to"
        >
          {{ tab.name }}
        </v-tab>
      </v-tabs>
      <v-container fluid>
        <v-row justify="center">
          <v-img
            alt="画像"
            src="@/assets/sample.jpg"
            max-height="400"
            transition="fade-transition"
          />
        </v-row>
        <v-row justify="center">
          <span class="text-h5 my-5">【お知らせ】</span>
          <v-slide-group show-arrows center-active>
            <v-slide-item
              v-for="item in news"
              :key="item"
            >
              <v-card style="margin:0 20px 8px 0; width: 480px; height: 280px;">
                <v-img
                  height="120px"
                  src="@/assets/news_sample.jpg"
                />
                <v-card-title>{{ item.title }}</v-card-title>
                <v-card-text class="text--primary">{{ item.summary }}</v-card-text>
                <v-card-action>
                  <v-btn
                    text
                    color="primary"
                  >>詳細を見る</v-btn>
                </v-card-action>
              </v-card>
            </v-slide-item>
          </v-slide-group>
        </v-row>
      </v-container>
      <router-view/>
    </v-main>

    <v-footer padless dark>
      <v-col cols="12" class="text-center">
        2022 ― <strong>Happy Position</strong>
      </v-col>
    </v-footer>
  </v-app>
</template>

<script>
import axios from 'axios'
export default {
  name: 'App',

  data: () => ({
    tabs: [
      { name:'トップページ', to: '/top' },
      { name:'お問い合わせ', to: '/contact' },
      { name:'会社案内', to: '/about' },
    ],
    news: [],
  }),
  created() {
    axios.get('/Vue-SQLite/test/dist/api/test.php').then((response) => {
      this.news = response.data
    })
  }
};
</script>
