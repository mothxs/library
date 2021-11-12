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
      width="1600"
    >
      <template>
        <form action="">
          <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
              <p class="modal-card-title">Editar libro</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <div class="columns">
                <div class="column">
                  <b-field label="Título" :type="getInputType('title')" :message="getErrorMessage('title')">
                    <b-input v-model="book.title" required></b-input>
                  </b-field>
                  <b-field label="Fecha de publicación" :type="getInputType('release_date')" :message="getErrorMessage('release_date')">
                    <b-datepicker
                      v-model="date"
                      :show-week-number="true"
                      locale="es-ES"
                      placeholder="Click para seleccionar..."
                      icon="calendar-today"
                      trap-focus
                    >
                    </b-datepicker>
                  </b-field>
                  <b-field label="ISBN" :type="getInputType('isbn')" :message="getErrorMessage('isbn')">
                    <b-input v-model="book.isbn"></b-input>
                  </b-field>
                  <b-field label="Nº de páginas" :type="getInputType('pages')" :message="getErrorMessage('pages')">
                    <b-input v-model="book.pages" type="number" min="1"></b-input>
                  </b-field>
                  <b-field label="Tipo de tapa" :type="getInputType('cover_type')" :message="getErrorMessage('cover_type')">
                    <b-input v-model="book.cover_type"></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <b-field label="Copyright" :type="getInputType('copyright')" :message="getErrorMessage('copyright')">
                    <b-input v-model="book.copyright"></b-input>
                  </b-field>
                  <b-field label="Lugar de publicación" :type="getInputType('publishing_place')" :message="getErrorMessage('publishing_place')">
                    <b-input v-model="book.publishing_place"></b-input>
                  </b-field>
                  <b-field label="Stock" :type="getInputType('qty')" :message="getErrorMessage('qty')">
                    <b-input v-model="book.qty" type="number" min="0"></b-input>
                  </b-field>
                  <b-field label="Subir foto" :type="getInputType('photo')" :message="getErrorMessage('photo')">
                    <b-field class="file is-primary" :class="{'has-name': !!file}">
                      <b-upload v-model="file" class="file-label is-success" rounded>
                        <span class="file-cta">
                          <b-icon class="file-icon" icon="upload"></b-icon>
                          <span class="file-label">{{ file.name || "Click para seleccionar"}}</span>
                        </span>
                      </b-upload>
                    </b-field>
                  </b-field>
                </div>
              </div>
            </section>
            <footer class="modal-card-foot">
              <b-button label="Actualizar" type="is-success" @click="update"/>
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
    item: {
      type: Object,
      required: true
    }
  },
  data: function () {
    return {
      isLoading: false,
      book: {},
      authors: [],
      file: {},
      errors: [],
      date: undefined
    };
  },
  created() {
    this.book = this.item;
    if(this.book.release_date) {
      this.date = new Date(this.book.release_date)
    }
    this.load()
  },
  methods: {
    load() {
      this.$emit("loading", true);
      axios.get("/api/authors").then((response) => {
        this.authors = response.data
      })
      .catch((error) => {
      })
      .finally(() => {
        this.$emit("loading", false)
      });
    },
    async update() {
      this.$emit("loading", true);

      const formData = new FormData();
      
      if(this.file.name) {
        formData.append('file', this.file, this.file.name);
        let response = await axios.post("/api/images", formData);

        if(response.status == 200) {
          this.book.photo = response.data.name;
        } else {
          this.$buefy.toast.open({
            message: 'Error al subir la imagen',
            type: 'is-danger'
          })
        }
      }

      if(this.date) {
        this.book.release_date = this.formatDate(this.date)
      }

      axios.put("/api/books/"+this.book.id, this.book).then(response => {
        this.$buefy.toast.open({
            message: '¡Libro actualizado con éxito!',
            type: 'is-success'
        })
        this.$emit('updated', response.data);
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al actualizar el libro',
            type: 'is-danger'
        })

        if(error.response.status == 422) {
          this.errors = error.response.data.errors
        }
      })
      .finally(() => {
        this.$emit("loading", false)
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