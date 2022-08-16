<template>
  <v-card>
    <v-card-title>
        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
    </v-card-title>
    <v-data-table :headers="headers" :items="devices" sort-by="os" :search="search" class="elevation-1">
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>TYMPAHEALTH</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn dark class="mb-2" v-bind="attrs" v-on="on">
              <span class="mr-2">Create Device</span>
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                    <v-form v-model="isFormValid" ref="form" class="mx-2">
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field v-model="editedItem.brand" label="Brand name" :rules="[rules.required]" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field v-model="editedItem.model" label="Model" :rules="[rules.required]" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field v-model="editedItem.os" label="OS"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-switch v-model="editedItem.is_new" :label="`Is New?`"></v-switch>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field v-model="editedItem.release_date" :rules="[rules.pattern]" required suffix="YYYY/MM"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="save" :disabled="!isFormValid">Save</v-btn>
                        </v-card-actions>
                </v-form>
              </v-container>
            </v-card-text>

          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this device?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
      <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="retrieveDevices">Reset</v-btn>
    </template>
  </v-data-table>
  </v-card>
</template>

<script>
    import { exit } from "process";
import DeviceDataService from "../services/DeviceDataService";
    export default {
        data: () => ({
            dialog: false,
            dialogDelete: false,
            isFormValid: false ,
            headers: [{
                text: 'Brand',
                align: 'start',
                filterable: false,
                value: 'brand',
                sortable: false,
                },
                { text: 'Model', value: 'model', sortable: false },
                { text: 'OS', value: 'os' },
                { text: 'Release Date', value: 'release_date', sortable: false },
                { text: "Actions", value: "actions", sortable: false },
            ],
            devices: [],
            search: '',
            editedIndex: -1,
            editedItem: {
                brand: '',
                model: '',
                os: '',
                is_new: false,
                release_date: '',
            },
            defaultItem: {
                brand: '',
                model: '',
                os: '',
                is_new: false,
                release_date: '',
            },
            rules: {
                required: value => !!value || 'Required.',
                pattern:v => /^\d{4}[\/\/](0?[1-9]|1[012])$/.test(v)||'The Release date should be in YYYY/MM Format.'
            },
        }),
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New device' : 'Edit Device'
            },
        },
        watch: {
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
                val || this.closeDelete()
            }
        },
        created () {
            this.retrieveDevices()
        },
        methods: {
            retrieveDevices () {
                DeviceDataService.getAll()
                    .then(response => {
                        this.devices = response.data.data;

                    })
                    .catch((e) => {
                        console.log(e);
                    });
        },

      editItem (item) {
        this.editedIndex = this.devices.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.devices.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        DeviceDataService.delete(this.editedItem.id)
                    .then(response => {
                        this.retrieveDevices()
                    });
        this.closeDelete()
      },
      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1

        })
      },
      save () {
        if (this.$refs.form.validate()) {
           if (this.editedIndex > -1) {
            Object.assign(this.devices[this.editedIndex], this.editedItem)
            DeviceDataService.update(this.editedItem.id, this.editedItem)
                        .then((res) => {
                            this.retrieveDevices()
                        }).catch((error) => {
                        console.log(error);
                    });
            } else {
                DeviceDataService.create(this.editedItem)
                    .then(response => (
                            this.retrieveDevices()
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
            this.close()
        }
      },
    },
  }
</script>