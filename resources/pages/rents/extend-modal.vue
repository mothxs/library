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
              <p class="modal-card-title">Extender fecha de devolución</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <p><b>La fecha de devolución se alargará una semana.</b> ¿Estás seguro?</p>
            </section>
            <footer class="modal-card-foot">
              <b-button label="Extender" type="is-warning" @click="update"/>
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
    update() {
      this.$emit("loading", true);

      let rent = {};
      Object.assign(rent, this.rent);
      rent.times_extended += 1;
      let date = new Date(rent.end_date);
      //Add 7 days to the end_date
      date.setDate(date.getDate() + 7);
      rent.end_date = this.formatDate(date);

      axios.put("/api/rents/"+rent.id, rent).then(response => {
        this.$buefy.toast.open({
            message: '¡Alquiler extendido con éxito!',
            type: 'is-success'
        })
        this.$emit('updated', response.data);
      })
      .catch(error => {
        if(error.response.status == 422) {
          this.$buefy.toast.open({
            message: 'Se ha alcanzado el limite de extensión en el alquier.',
            type: 'is-danger'
          })
          return;
        }

        this.$buefy.toast.open({
            message: 'Error al extender el aquiler',
            type: 'is-danger'
        })
      })
      .finally(() => {
        this.$emit("loading", false)
      });
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
  }
};
</script>
