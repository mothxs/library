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
              <p class="modal-card-title">Archivar libro</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <p>¿Estás seguro?</p>
            </section>
            <footer class="modal-card-foot">
              <b-button label="Archivar" type="is-danger" @click="destroy"/>
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
      book: {}
    };
  },
  created() {
    this.book = this.item;
  },
  methods: {
    destroy() {
      this.$emit("loading", true);

      if(this.book.rents && this.book.rents.length > 0) {
        this.$buefy.toast.open({
            message: 'El libro tiene alquileres',
            type: 'is-danger'
        })
        return false;
      }

      axios.delete("/api/books/"+this.book.id).then(response => {
        this.$buefy.toast.open({
            message: '¡Libro archivado con éxito!',
            type: 'is-success'
        })
        this.$emit('deleted');
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al archivar el libro',
            type: 'is-danger'
        })
      })
      .finally(() => {
        this.$emit("loading", false)
      });
    }
  }
};
</script>
