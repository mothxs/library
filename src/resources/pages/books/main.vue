<template>
  <section>
    <b-loading v-model="isLoading"></b-loading>
    <div class="block">
      <h2 class="title is-3 is-inline">Catálogo de libros</h2>
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
        detailed
      >
        <b-table-column field="title" label="Título" v-slot="props" sortable searchable>
          {{ props.row.title }}
        </b-table-column>

        <b-table-column field="pages" label="Nº páginas" v-slot="props" sortable searchable>
          {{ props.row.pages }}
        </b-table-column>

        <b-table-column field="isbn" label="ISBN" v-slot="props" sortable searchable>
          {{ props.row.isbn }}
        </b-table-column>

        <b-table-column field="qty" label="Stock" v-slot="props" sortable searchable>
          {{ props.row.qty }}
        </b-table-column>

        <b-table-column v-slot="props">
          <b-button icon-left="pencil" type="is-warning" @click="showEdit(props.row)">
          </b-button>
          <b-button icon-left="delete" type="is-danger" @click="showDelete(props.row)">
          </b-button>
        </b-table-column>

        <template #detail="props">
            <article class="media">
                <figure class="media-left">
                    <p class="image is-128x128">
                        <img v-if="props.row.photo" :src="'/'+props.row.photo">
                        <img v-else :src="'https://buefy.org/static/img/placeholder-128x128.png'" alt="Book image">
                    </p>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <p>
                          Tipo de tapa: {{ props.row.cover_type }}
                          <br>
                          Copyright: {{ props.row.copyright }}
                          <br>
                          Lugar de publicación: {{ props.row.publishing_place }}
                          <br>
                          Fecha de publicación: {{ props.row.release_date }}
                        </p>
                    </div>
                </div>
            </article>
        </template>

        <template #empty>
          <div class="has-text-centered">No hay datos</div>
        </template>
      </b-table>
    </div>
    <create-book-modal 
      v-if="showNewModal" 
      @close="showNewModal = !showNewModal"
      @created="addNewItem($event)"
      @loading="isLoading = $event.value">
    </create-book-modal>
    <edit-book-modal 
      v-if="showEditModal" 
      @close="showEditModal = !showEditModal"
      @updated="editItem($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </edit-book-modal>
    <delete-book-modal 
      v-if="showDeleteModal" 
      @close="showDeleteModal = !showDeleteModal"
      @deleted="remove($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </delete-book-modal>
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
        .get("/api/books")
        .then(response => {
          this.data = response.data;
        })
        .catch(error => {
          this.$buefy.toast.open({
            message: 'Error al cargar el catálogo',
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