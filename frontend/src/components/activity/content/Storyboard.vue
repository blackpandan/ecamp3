<template>
  <div>
    <v-container fluid>
      <v-row no-gutters class="text-subtitle-2">
        <v-col cols="2">
          {{ $tc('activityContent.storyboard.entity.section.fields.column1') }}
        </v-col>
        <v-col cols="7">
          {{ $tc('activityContent.storyboard.entity.section.fields.column2') }}
        </v-col>
        <v-col cols="2">
          {{ $tc('activityContent.storyboard.entity.section.fields.column3') }}
        </v-col>
        <v-col cols="1" />
      </v-row>
      <div v-for="section in activityContent.sections().items" :key="section._meta.self">
        <!-- add before -->
        <v-row no-gutters class="row-inter" justify="center">
          <v-col cols="1">
            <v-btn icon
                   small
                   class="button-add"
                   color="success"
                   @click="addSection">
              <v-icon>mdi-plus</v-icon>
            </v-btn>
          </v-col>
        </v-row>

        <api-form :entity="section">
          <v-row dense>
            <v-col cols="2">
              <api-textarea
                fieldname="column1"
                auto-grow
                rows="2" />
            </v-col>
            <v-col cols="7">
              <api-textarea
                fieldname="column2"
                auto-grow
                rows="4" />
            </v-col>
            <v-col cols="2">
              <api-textarea
                fieldname="column3"
                auto-grow
                rows="2" />
            </v-col>
            <v-col cols="1">
              <div class="float-right section-buttons">
                <v-btn icon small class="float-right"><v-icon>mdi-arrow-up-bold</v-icon></v-btn>
                <dialog-entity-delete :entity="section">
                  <template v-slot:activator="{ on }">
                    <v-btn icon
                           small
                           color="error"
                           class="float-right"
                           v-on="on">
                      <v-icon>mdi-delete</v-icon>
                    </v-btn>
                  </template>
                </dialog-entity-delete>
                <v-btn icon small class="float-right"><v-icon>mdi-arrow-down-bold</v-icon></v-btn>
              </div>
            </v-col>
          </v-row>
        </api-form>
      </div>

      <!-- add at end position -->
      <v-row no-gutters justify="center">
        <v-col cols="1">
          <v-btn icon
                 small
                 class="button-add"
                 color="success"
                 @click="addSection">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import ApiTextarea from '@/components/form/api/ApiTextarea'
import ApiForm from '@/components/form/api/ApiForm'
import DialogEntityDelete from '@/components/dialog/DialogEntityDelete'

export default {
  name: 'Storyboard',
  components: {
    ApiForm,
    ApiTextarea,
    DialogEntityDelete
  },
  props: {
    activityContent: { type: Object, required: true }
  },
  methods: {
    async addSection () {
      // this.isAdding = true
      await this.api.post('/content-type/storyboards', {
        activityContentId: this.activityContent.id,
        pos: 100
      })
      await this.refreshContent()
      // this.isAdding = false
    },
    async refreshContent () {
      await this.api.reload(this.activityContent)
    }
  }
}
</script>

<style scoped>
.section-buttons{
  width:40px;
  margin-top:10px;
}

.row-inter {
  height: 4px;
  transition: 0s height;
  transition-duration: 0.5s;
}
.row-inter:hover {
  height: 30px;
  background-color: #EEEEEE;
  transition-delay: 0.3s;
}

.row-inter .button-add {
  opacity: 0;
  height: 0;
  transition: 0s height, opacity;
  transition-duration: 0.5s;
}

.row-inter:hover .button-add {
  opacity: 1;
  height: 30px;
  transition-delay: 0.3s;
}

</style>
