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
              <p class="modal-card-title">Nueva editorial</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <div class="columns">
                <div class="column">
                  <b-field label="Nombre" :type="getInputType('name')" :message="getErrorMessage('name')">
                    <b-input v-model="editorial.name" required></b-input>
                  </b-field>
                  <b-field label="País" :type="getInputType('country')" :message="getErrorMessage('country')">
                    <b-input v-model="editorial.country"></b-input>
                  </b-field>
                  <b-field label="Fecha de fundación" :type="getInputType('foundation_date')" :message="getErrorMessage('foundation_date')">
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
                  <b-field label="Página web" :type="getInputType('website')" :message="getErrorMessage('website')">
                    <b-input v-model="editorial.website"></b-input>
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
      editorial: {},
      editorials: [],
      file: {},
      errors: [],
      date: undefined
    };
  },
  created() {
    this.load()
  },
  methods: {
    load() {
      this.$emit("loading", true);
      axios.get("/api/editorials").then((response) => {
        this.editorials = response.data
      })
      .catch((error) => {
      })
      .finally(() => {
        this.$emit("loading", false)
      });
    },
    create() {
      this.$emit("loading", true);

      if(this.date) {
        this.editorial.foundation_date = this.formatDate(this.date)
      }

      axios.post("/api/editorials", this.editorial).then(response => {
        this.$buefy.toast.open({
            message: 'Autor creado con éxito!',
            type: 'is-success'
        })
        this.$emit('created', response.data);
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al crear un nuevo autor',
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