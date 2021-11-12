<template>
  <section>
    <b-loading v-model="isLoading"></b-loading>
    <div class="block">
      <h2 class="title is-3 is-inline">Socios</h2>
      <b-button
        @click="showNewModal = !showNewModal"
        type="is-success is-pulled-right"
        icon-left="plus"
        >
        Nueva
      </b-button
      >
    </div>
    <div class="block pt-5">
      <b-table
        :data="data"
        :paginated="true"
        :mobile-cards="true"
      >
        <b-table-column field="name" label="Nombre" v-slot="props" sortable searchable>
          {{ props.row.name }}
        </b-table-column>

            <b-table-column field="surname" label="Apellido" v-slot="props" sortable searchable>
          {{ props.row.surname }}
        </b-table-column>

        <b-table-column field="id_card" label="DNI" v-slot="props" sortable searchable>
          {{ props.row.id_card }}
        </b-table-column>

        <b-table-column field="age" label="Edad" v-slot="props" sortable searchable>
          {{ props.row.age }}
        </b-table-column>

        <b-table-column field="address" label="Dirección" v-slot="props" sortable searchable>
          {{ props.row.address }}
        </b-table-column>

        <b-table-column v-slot="props">
          <b-button icon-left="pencil" type="is-warning" @click="showEdit(props.row)">
          </b-button>
          <b-button icon-left="delete" type="is-danger" @click="showDelete(props.row)">
          </b-button>
        </b-table-column>

        <template #empty>
          <div class="has-text-centered">No hay datos</div>
        </template>
      </b-table>
    </div>
    <create-partners-modal 
      v-if="showNewModal" 
      @close="showNewModal = !showNewModal"
      @created="addNewItem($event)"
      @loading="isLoading = $event.value">
    </create-partners-modal>
    <edit-partners-modal 
      v-if="showEditModal" 
      @close="showEditModal = !showEditModal"
      @updated="editItem($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </edit-partners-modal>
    <delete-partners-modal 
      v-if="showDeleteModal" 
      @close="showDeleteModal = !showDeleteModal"
      @deleted="remove($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </delete-partners-modal>
  </section>
</template>

<script>
export default {
  data: function () {
    return {
      isLoading: false,
      data: [],
      showNewModal: false,
      showEditModal: false,
      showDeleteModal: false,
      selectedItem: {}
    };
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.isLoading = true;
      axios
        .get("/api/partners")
        .then(response => {
          this.data = response.data;
        })
        .catch(error => {
          this.$buefy.toast.open({
            message: 'Error al cargar los socios',
            type: 'is-danger'
          })
        })
        .finally(() => {
          this.isLoading = false
        });
    },
    addNewItem(newItem) {
      this.data.push(newItem)
      this.showNewModal = false
    },
    showEdit(item) {
      this.selectedItem = item;
      this.showEditModal = true;
    },
    editItem(editemItem) {
      this.selectedItem = editemItem;
      this.showEditModal = false
    },
    showDelete(item) {
      this.selectedItem = item;
      this.showDeleteModal = true;
    },
    remove() {
      const index = this.data.findIndex(item => item.id == this.selectedItem.id);
      this.data.splice(index, index >= 0 ? 1 : 0);
      this.showDeleteModal = false;
    }
  },
};
</script>