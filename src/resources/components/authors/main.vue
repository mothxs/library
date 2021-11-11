<template>
  <section>
    <b-loading v-model="isLoading"></b-loading>
    <div class="block">
      <h2 class="title is-3 is-inline">Autores</h2>
      <b-button
        @click="showNewModal = !showNewModal"
        type="is-success is-pulled-right"
        icon-left="plus"
        >
        Nuevo
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

        <b-table-column field="country" label="País" v-slot="props" sortable searchable>
          {{ props.row.country }}
        </b-table-column>

        <b-table-column field="language" label="Idioma de escritura" v-slot="props" sortable searchable>
          {{ props.row.language }}
        </b-table-column>

        <b-table-column field="birth_date" label="Fecha de nacimiento" v-slot="props" sortable searchable>
          {{ props.row.birth_date }}
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
    <create-authors-modal 
      v-if="showNewModal" 
      @close="showNewModal = !showNewModal"
      @created="addNewItem($event)"
      @loading="isLoading = $event.value">
    </create-authors-modal>
    <edit-authors-modal 
      v-if="showEditModal" 
      @close="showEditModal = !showEditModal"
      @updated="editItem($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </edit-authors-modal>
    <delete-authors-modal 
      v-if="showDeleteModal" 
      @close="showDeleteModal = !showDeleteModal"
      @deleted="remove($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </delete-authors-modal>
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
        .get("/api/authors")
        .then(response => {
          this.data = response.data;
        })
        .catch(error => {
          this.$buefy.toast.open({
            message: 'Error al cargar el catálogo',
            type: 'is-danger'
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    addNewItem(newItem) {
      this.data.push(newItem);
      this.showNewModal = false;
    },
    showEdit(item) {
      this.selectedItem = item;
      this.showEditModal = true;
    },
    editItem(editedItem) {
      this.selectedItem = editedItem;
      this.showEditModal = false;
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