<template>
  <section>
    <b-loading v-model="isLoading"></b-loading>
    <div class="block">
      <h2 class="title is-3 is-inline">Alquileres</h2>
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
        :row-class="(row,index) => this.getRowClass(row,index)"
      >
        <b-table-column field="partner.name" label="Socio" v-slot="props" sortable searchable>
          {{ props.row.partner.name }}
        </b-table-column>

        <b-table-column field="book.title" label="Libro" v-slot="props" sortable searchable>
          {{ props.row.book.title }}
        </b-table-column>

        <b-table-column field="start_date" label="Fecha inicio del alquiler" v-slot="props" sortable searchable>
          {{ props.row.start_date }}
        </b-table-column>

        <b-table-column field="end_date" label="Fecha de devolución" v-slot="props" sortable searchable>
          {{ props.row.end_date }}
        </b-table-column>

        <b-table-column field="qty" label="Cantidad" v-slot="props" sortable searchable>
          {{ props.row.qty }}
        </b-table-column>

        <b-table-column field="times_extended" label="Veces extendido" v-slot="props" sortable searchable>
          {{ props.row.times_extended }}
        </b-table-column>

        <b-table-column v-slot="props" width="130">
          <b-tooltip label="Devolución" position="is-top" type="is-dark">
            <b-button icon-left="keyboard-return" type="is-success" @click="showReturn(props.row)">
            </b-button>
          </b-tooltip>
          <b-tooltip label="Extender" position="is-top" type="is-dark">
            <b-button icon-left="clock-outline" type="is-dark" @click="showExtend(props.row)">
            </b-button>
          </b-tooltip>
        </b-table-column>

        <template #empty>
          <div class="has-text-centered">No hay datos</div>
        </template>
      </b-table>
    </div>
    <create-rent-modal 
      v-if="showNewModal" 
      @close="showNewModal = !showNewModal"
      @created="addNewItem($event)"
      @loading="isLoading = $event.value"
      :books="books"
      :partners="partners">
    </create-rent-modal>
    <return-rent-modal 
      v-if="showReturnModal" 
      @close="showReturnModal = !showReturnModal"
      @deleted="remove($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </return-rent-modal>
    <extend-rent-modal 
      v-if="showExtendModal" 
      @close="showExtendModal = !showExtendModal"
      @updated="editItem($event)"
      @loading="isLoading = $event.value"
      :item="selectedItem">
    </extend-rent-modal>
  </section>
</template>

<script>
export default {
  data: function () {
    return {
      isLoading: false,
      data: [],
      partners: [],
      books: [],
      showNewModal: false,
      showExtendModal: false,
      showReturnModal: false,
      selectedItem: {},
      today: new Date()
    };
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.isLoading = true;
      axios
        .get("/api/rents")
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

      axios.get("/api/partners").then((response) => {
        this.partners = response.data
      })
      .catch((error) => {
      })
      .finally(() => {
      });

      axios.get("/api/books").then((response) => {
        this.books = response.data
      })
      .catch((error) => {
      })
      .finally(() => {
      });
    },
    addNewItem(newItem) {
      this.data.push(newItem)
      this.showNewModal = false
    },
    showExtend(item) {
      this.selectedItem = item;
      this.showExtendModal = true;
    },
    editItem(editedItem) {
      const index = this.data.findIndex(item => item.id == this.selectedItem.id);
      this.$set(this.data, index, editedItem);
      this.showExtendModal = false
    },
    showReturn(item) {
      this.selectedItem = item;
      this.showReturnModal = true;
    },
    remove() {
      const index = this.data.findIndex(item => item.id == this.selectedItem.id);
      this.data.splice(index, index >= 0 ? 1 : 0);
      this.showReturnModal = false;
    },
    getRowClass(row, index) {
      if(this.today >= new Date(row.end_date)) {
        return 'is-danger';
      }

      let milisecondDiff = this.today - new Date(row.end_date)
      if(milisecondDiff / (1000 * 60 * 60 * 24) >= -5) {
        return 'is-warning';
      }

      return '';
    }
  },
};
</script>

<style>
  tr.is-warning {
    background:#ffdc7d;
    color: black;
  }
  tr.is-danger {
    background:#f03a5f;
    color: black;
  }
</style>