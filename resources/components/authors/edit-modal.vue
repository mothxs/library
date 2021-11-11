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
              <p class="modal-card-title">Editar autor</p>
              <button type="button" class="delete" @click="$emit('close')" />
            </header>
            <section class="modal-card-body">
              <div class="columns">
                <div class="column">
                  <b-field label="Nombre" :type="getInputType('name')" :message="getErrorMessage('name')">
                    <b-input v-model="item.name" required></b-input>
                  </b-field>
                  <b-field label="Apellido" :type="getInputType('surname')" :message="getErrorMessage('surname')">
                    <b-input v-model="item.surname"></b-input>
                  </b-field>
                  <b-field label="Fecha de nacimiento" :type="getInputType('birth_date')" :message="getErrorMessage('birth_date')">
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
                  <b-field label="País" :type="getInputType('country')" :message="getErrorMessage('country')">
                    <b-input v-model="item.country"></b-input>
                  </b-field>
                  <b-field label="Idioma de escritura" :type="getInputType('language')" :message="getErrorMessage('language')">
                    <b-input v-model="item.language"></b-input>
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
      author: {},
      file: {},
      errors: [],
      date: undefined
    };
  },
  created() {
    this.author = this.item;
    if(this.author.birth_date) {
      this.date = new Date(this.author.birth_date)
    }
  },
  methods: {
    update() {
      this.$emit("loading", true);

      if(this.date) {
        this.author.birth_date = this.formatDate(this.date)
      }

      axios.put("/api/authors/"+this.author.id, this.author).then(response => {
        this.$buefy.toast.open({
            message: '¡Autor actualizado con éxito!',
            type: 'is-success'
        })
        this.$emit('updated', response.data);
      })
      .catch(error => {
        this.$buefy.toast.open({
            message: 'Error al actualizar el autor',
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