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
                                <v-row>
                                    <v-col cols="5" class="text-body-1 text-center cell_top remove_border-right">
                                        見出し<br>
                                        <span style="color: red; font-size: 16px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell_top">
                                        <v-text-field
                                        outlined
                                        dense
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="5" class="text-body-1 text-center cell remove_border-right">
                                        概要<br>
                                        <span style="color: red; font-size: 16px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell">
                                        <v-text-field
                                        outlined
                                        dense
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="5" class="text-body-1 text-center cell remove_border-right">
                                        内容<br>
                                        <span style="color: red; font-size: 16px;">※必須</span>
                                    </v-col>
                                    <v-col cols="7" class="cell">
                                        <v-text-field
                                        outlined
                                        dense
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row justify="end" class="mt-6">
                                    <v-btn
                                        color="success"
                                        large
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
export default {
    data() {
        return {}
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
</style>