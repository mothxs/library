<template>
  <section>
    <b-modal
      :active="true"
      has-modal-card
      trap-focus
      :destroy-on-hide="false"
      aria-role="dialog"
      close-button-aria-label="Close"
      aria-modal
    >
      <template>
        <form action="">
          <div class="modal-card" style="width: 960">
            <header class="modal-card-head">
              <p class="modal-card-title">Nuevo alquiler</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <div class="columns">
                <div class="column">
                  <b-field label="Fecha de inicio de alquiler" :type="getInputType('start_date')" :message="getErrorMessage('start_date')">
                    <b-datepicker
                      v-model="startDate"
                      :show-week-number="true"
                      locale="es-ES"
                      placeholder="Click para seleccionar..."
                      icon="calendar-today"
                      trap-focus
                      :min-date="new Date(new Date().getFullYear(), new Date().getMonth() , new Date().getDate())"
                      append-to-body
                    >
                    </b-datepicker>
                  </b-field>

                  <b-field label="Fecha de devolución" :type="getInputType('end_date')" :message="getErrorMessage('end_date')">
                    <b-datepicker
                      v-model="endDate"
                      :show-week-number="true"
                      locale="es-ES"
                      placeholder="Click para seleccionar..."
                      icon="calendar-today"
                      trap-focus
                      :min-date="new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate())"
                      append-to-body
                    >
                    </b-datepicker>
                  </b-field>
                  <b-field label="Socio" :type="getInputType('partner_id')" :message="getErrorMessage('partner_id')">
                    <b-autocomplete
                        rounded
                        v-model="partnerName"
                        :data="filteredPartners"
                        placeholder="Nombre del socio"
                        icon="magnify"
                        clearable
                        field="name"
                        @select="option => selectedPartner = option">
                        <template #empty>No se han encontrado resultados</template>
                    </b-autocomplete>
                  </b-field>
                  <b-field label="Libro" :type="getInputType('book_id')" :message="getErrorMessage('book_id')">
                    <b-autocomplete
                        rounded
                        v-model="bookName"
                        :data="filteredBooks"
                        placeholder="Nombre del libro"
                        icon="magnify"
                        clearable
                        field="title"
                        @select="option => selectedBook = option">
                        <template #empty>No se han encontrado resultados</template>
                    </b-autocomplete>
                  </b-field>
                  <b-field label="Cantidad" :type="getInputType('qty')" :message="getErrorMessage('qty')">
                    <b-input v-model="rent.qty" type="number" min="1"></b-input>
                  </b-field>
                </div>
              </div>
            </section>
            <footer class="modal-card-foot">
              <b-button label="Crear" type="is-success" @click="create"/>
              <b-button label="Cerrar" @click="$emit('close')"/>
            </footer>
          </div>
        </form>
      </template>
    </b-modal>
  </section>
</template>

<script>
export default {
  props: {
    partners: {
      type: Array,
      required: true
    },
    books: {
      type: Array,
      required: true
    }
  },
  data: function () {
    return {
      isLoading: false,
      rent: {},
      errors: [],
      startDate: undefined,
      endDate: undefined,
      partnerName: '',
      selectedPartner: {},
      bookName: '',
      selectedBook: {}
    };
  },
  computed: {
    filteredPartners() {
      return this.partners.filter((option) => {
        return option.name.toString().toLowerCase().indexOf(this.partnerName.toLowerCase()) >= 0
      })
    },
    filteredBooks() {
      return this.books.filter((option) => {
        return option.title.toString().toLowerCase().indexOf(this.bookName.toLowerCase()) >= 0
      })
    }
  },
  methods: {
    create() {
      
      if(this.selectedBook.qty < this.rent.qty) {
        this.$buefy.toast.open({
            message: 'La cantidad del alquiler supera al stock del libro',
            type: 'is-danger'
        });
        return false;
      }

      this.$emit("loading", true);

      if(this.startDate) {
        this.rent.start_date = this.formatDate(this.startDate);
      }
      if(this.endDate) {
        this.rent.end_date = this.formatDate(this.endDate);
      }
      if(this.selectedBook) {
        this.rent.book_id = this.selectedBook.id;
      }
      if(this.selectedPartner) {
        this.rent.partner_id = this.selectedPartner.id;
      }

      axios.post("/api/rents", this.rent).then(response => {
        this.$buefy.toast.open({
            message: 'Alquiler creado con éxito!',
            type: 'is-success'
        })
        this.$emit('created', response.data);
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al crear un nuevo alquiler',
            type: 'is-danger'
        });

        if(error.response.status == 422) {
          this.errors = error.response.data.errors;
        }
      })
      .finally(() => {
        this.$emit("loading", false);
      });
    },
    getInputType(input) {
      if(this.errors[input]) {
        return 'is-danger';
      }
      return '';
    },
    getErrorMessage(input) {
      if(this.errors[input]) {
        return this.errors[input][0];
      }
      return '';
    },
    formatDate(date) {
      var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();

      if (month.length < 2) 
          month = '0' + month;
      if (day.length < 2) 
          day = '0' + day;

      return [year, month, day].join('-');
    }
  },
};
</script>