<template>
  <div class="container calculator">
    <h1 class="text-center">Calculadora de Juros Compostos</h1>
    <div class="row">
      <div class="col-md-12 parameters">
        <form @click:submit.prevent>
          <label>Capital:</label>
          <input
            v-model="capital"
            type="text"
            name="capital"
            placeholder="Insira o capital inicial."
          /><br />
          <label>Taxa de juros:</label>
          <input
            v-model="juros"
            type="number"
            name="juros"
            placeholder="Insira a taxa de juros."
          /><br />
          <label>Periodo em meses:</label>
          <input
            v-model="meses"
            type="number"
            name="meses"
            placeholder="Insira a quantiade de meses."
          /><br />
          <input @click="getValue" type="button" value="Calcular" />
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 results">
        <h2>Resultados</h2>
        <span>
          Juros acumulado:
          <span v-if="montante != null">
            {{ final }}
          </span></span
        ><br />
        <span>
          Montante final:
          <span v-if="montante != null">
            {{ montante }}
          </span></span
        >
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      capital: null,
      juros: null,
      meses: null,
      montante: null,
      final: null,
    };
  },
  methods: {
    getValue() {
      axios
        .post("api/calculator", null, {
          params: {
            capital: this.capital,
            juros: this.juros,
            meses: this.meses,
          },
        })
        .then((resp) => {
          this.montante = resp.data;
          this.final = this.montante - this.capital;
          this.final = this.final.toLocaleString("pt-br", {
            style: "currency",
            currency: "BRL",
          });
          this.montante = this.montante.toLocaleString("pt-br", {
            style: "currency",
            currency: "BRL",
          });
          this.capital = "";
          this.juros = "";
          this.meses = "";
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>
<style scoped>
.calculator {
  margin-top: 50px;
  padding: 30px;
}
.parameters {
  padding: 20px;
  border: 2px solid rgb(170, 170, 170);
  border-radius: 5px;
}
.results {
  margin-top: 20px;
  padding: 20px;
  border: 2px solid rgb(170, 170, 170);
  border-radius: 5px;
}
</style>
