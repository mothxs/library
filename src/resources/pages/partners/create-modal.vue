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
              <p class="modal-card-title">Nuevo socio</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <div class="columns">
                <div class="column">
                  <b-field label="Nombre" :type="getInputType('name')" :message="getErrorMessage('name')">
                    <b-input v-model="partner.name" required></b-input>
                  </b-field>
                  <b-field label="Apellido" :type="getInputType('surname')" :message="getErrorMessage('surname')">
                    <b-input v-model="partner.surname"></b-input>
                  </b-field>
                  <b-field label="DNI" :type="getInputType('id_card')" :message="getErrorMessage('id_card')">
                    <b-input v-model="partner.id_card" maxlength="9"></b-input>
                  </b-field>
                  <b-field label="Fecha de nacimiento" :type="getInputType('birth_date')" :message="getErrorMessage('birth_date')">
                    <b-datepicker
                      v-model="date"
                      :show-week-number="true"
                      locale="es-ES"
                      placeholder="Click para seleccionar..."
                      icon="calendar-today"
                      trap-focus
                      append-to-body
                    >
                    </b-datepicker>
                  </b-field>
                  <b-field label="Dirección" :type="getInputType('address')" :message="getErrorMessage('address')">
                    <b-input v-model="partner.address"></b-input>
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
  data: function () {
    return {
      isLoading: false,
      partner: {},
      partners: [],
      errors: [],
      date: undefined
    };
  },
  methods: {
    create() {
      this.$emit("loading", true);

      if(this.date) {
        this.partner.birth_date = this.formatDate(this.date)
      }

      axios.post("/api/partners", this.partner).then(response => {
        this.$buefy.toast.open({
            message: 'Socio creado con éxito!',
            type: 'is-success'
        })
        this.$emit('created', response.data);
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al crear un nuevo socio',
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