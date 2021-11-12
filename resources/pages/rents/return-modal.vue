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
              <p class="modal-card-title">Devolver libros</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <p><b>Volveran a estar disponibles en el stock.</b>¿Estás seguro?</p>
            </section>
            <footer class="modal-card-foot">
              <b-button label="Devolver" type="is-success" @click="destroy"/>
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
      rent: {}
    };
  },
  created() {
    this.rent = this.item;
  },
  methods: {
    destroy() {
      this.$emit("loading", true);

      axios.delete("/api/rents/"+this.rent.id).then(response => {
        this.$buefy.toast.open({
            message: '¡Alquiler devuelto con éxito!',
            type: 'is-success'
        })
        this.$emit('deleted');
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al realizar la devolución',
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
