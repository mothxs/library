<template>
  <section>
    <b-modal
      :active="true"
      has-modal-card
      trap-focus
      :destroy-on-hide="false"
      aria-role="dialog"
      aria-label="Example Modal"
      close-button-aria-label="Close"
      aria-modal
      width="1600"
    >
      <template #default="props">
        <form action="">
          <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
              <p class="modal-card-title">Nuevo libro</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <div class="columns">
                <div class="column">
                  <b-field label="Título">
                    <b-input v-model="book.title" required></b-input>
                  </b-field>
                  <b-field label="Fecha de publicación">
                    <b-datepicker
                      v-model="book.date"
                      :show-week-number="true"
                      locale="es-ES"
                      placeholder="Click para seleccionar..."
                      icon="calendar-today"
                      trap-focus
                    >
                    </b-datepicker>
                  </b-field>
                  <b-field label="ISBN">
                    <b-input v-model="book.isbn"></b-input>
                  </b-field>
                  <b-field label="Nº de páginas">
                    <b-input v-model="book.pages"></b-input>
                  </b-field>
                  <b-field label="Tipo de tapa">
                    <b-input v-model="book.cover_type"></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <b-field label="Copyright">
                    <b-input v-model="book.copyright"></b-input>
                  </b-field>
                </div>
              </div>
            </section>
            <footer class="modal-card-foot">
              <b-button label="Crear" type="is-success" />
              <b-button label="Cerrar" @click="$emit('close')" />
            </footer>
          </div>
        </form>
      </template>
    </b-modal>
  </section>
</template>

<script>
module.exports = {
  data: function () {
    return {
      isLoading: false,
      book: {},
    };
  },
  methods: {
    save() {
      this.$emit("loading", true);
      axios
        .get("/api/books")
        .then((response) => {
          this.$emit(response.data);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => this.$emit("loading", false));
    },
  },
};
</script>