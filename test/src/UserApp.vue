<template>
  <v-app>
    <v-app-bar
      app
      color="#b5e61d"
      short
      flat
    >
      <div class="d-flex align-center">
        <v-img
          alt="Happy Position Logo"
          contain
          src="@/assets/logo.png"
          height="56"
          max-width="56"
          transition="scale-transition"
        />
        <v-toolbar-title class="text-subtitle-1 text-md-h5">Happy Position ホームページ</v-toolbar-title>
      </div>
      <template v-slot:extension>
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
      </template>
    </v-app-bar>

    <v-main>
      <v-container fluid class="pa-0">
        <v-row justify="center" no-gutters>
          <v-col cols="12" md="9">
            <v-img
              alt="画像"
              src="@/assets/Top.png"
              width="100%"
              transition="fade-transition"
            />
          </v-col>
        </v-row>
        <!-- お知らせが少ないときの応急処置 -->
        <v-row justify="center" v-if="news.length === 1 || news.length === 2 && !$vuetify.breakpoint.mobile">
          <v-col cols="12" class="text-h5 text-center">【お知らせ】</v-col>
          <v-col cols="5" v-for="item in news" :key="item">
            <v-card
            v-resize="onResize"
            :width="$vuetify.breakpoint.mobile ? (display_width - 112) : (display_width - 128) / 2"
            style="margin: 0 auto; height: 280px;"
            >
              <v-img
                height="120px"
                contain
                src="@/assets/news.png"
              />
              <v-card-title class="text-body-1">{{ item.title }}</v-card-title>
              <v-card-text class="text--primary">{{ item.summary }}</v-card-text>
              <v-card-action>
                <v-btn
                  text
                  color="primary"
                  plain
                  @click.stop="show_detail(item)"
                >>詳細を見る</v-btn>
                
              </v-card-action>
            </v-card>
          </v-col>
          <v-dialog v-model="dialog" max-width="800">
            <v-card>
              <v-card-title class="text-h5">
                {{ dialog_title }}
              </v-card-title>
              <v-divider class="mx-3 mb-4"></v-divider>
              <v-card-text>
                {{ dialog_content }}
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="#b5e61d"
                  text
                  @click.stop="dialog = false"
                >
                  CLOSE
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
        <v-row justify="center" v-else>
          <v-col cols="12" class="text-h5 text-center">【お知らせ】</v-col>
          <v-col cols="12" style="justify-content: center">
            <v-slide-group show-arrows center-active>
              <v-slide-item
                v-for="item in news"
                :key="item"
              >
                <v-card
                v-resize="onResize"
                :width="$vuetify.breakpoint.mobile ? (display_width - 112) : (display_width - 128) / 2"
                style="margin:0 20px 8px 0; height: 280px;">
                  <v-img
                    height="120px"
                    :src="item.image"
                    contain
                  />
                  <v-card-title class="text-body-1">{{ item.title }}</v-card-title>
                  <v-card-text class="text--primary">{{ item.summary }}</v-card-text>
                  <v-card-action>
                    <v-btn
                      text
                      color="primary"
                      plain
                      @click.stop="show_detail(item)"
                    >>詳細を見る</v-btn>
                    
                  </v-card-action>
                </v-card>
              </v-slide-item>
            </v-slide-group>
          </v-col>
          <v-dialog v-model="dialog" max-width="800">
            <v-card>
              <v-card-title class="text-h5">
                {{ dialog_title }}
              </v-card-title>
              <v-card-text>
                {{ dialog_content }}
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="#b5e61d"
                  text
                  @click.stop="dialog = false"
                >
                  CLOSE
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
      </v-container>

      <transition name="fade">
        <router-view/>
      </transition>
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
    dialog: false,
    dialog_title: '',
    dialog_content: '',
    display_width: null,
    display_height: null,
  }),
  created() {
    axios.get('./api/getNews.php').then((response) => {
      this.news = response.data
    })

    this.display_width = document.body.clientWidth
    this.display_height = document.documentElement.clientHeight
  },
  methods: {
    show_detail(item) {
      this.dialog = true
      this.dialog_title = item.title
      this.dialog_content = item.content
    },
    onResize () {
        this.display_width = document.body.clientWidth
        this.display_height = document.documentElement.clientHeight
      },
  }
};
</script>

<style scoped>
.fade-enter-active {
  transition: opacity 1s;
  opacity: 0;
}

.fade-enter-to {
  opacity: 1;
}
</style>