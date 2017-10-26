<template>
  <div v-hotkey="keymap">

    <div class="row"  v-loading.body="terminalLoading" element-loading-text="Espere...">
      <!-- Detalle de venta -->
      <div class="col-xs-12 col-sm-8">
        <section class="invoice" style="margin: 0;">
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="resumen.detalles.length > 0" v-for="detalle in resumen.detalles">
                    <td>{{ detalle.producto.nombre }}</td>
                    <td>{{ detalle.producto.barcode }}</td>
                    <td>{{ detalle.producto.precio_venta }}</td>
                    <td>{{ detalle.cantidad }}</td>
                    <td>$ {{ detalle.producto.precio_venta * detalle.cantidad }}</td>
                    <td>
                      <el-button type="danger" icon="delete" size="small" @click="removerProducto(detalle.id)"></el-button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>

      <!-- Panel de operacion -->
      <div class="col-xs-12 col-sm-4">
      <div class="box box-solid">
        <div class="box-body">

          <div class="row">
            <div class="col-xs-12">
              <div class="callout callout-info">
                <div class="row">
                  <div class="col-sm-6">
                    <p>
                      Total
                    </p>
                    <h2 style="padding:0px;margin:0px;">
                      {{ resumen.costoTotal }}
                    </h2>

                  </div>
                  <div class="col-sm-6">
                    <p>
                      Productos
                    </p>
                    <h2 style="padding:0px;margin:0px;">
                      {{ resumen.cantidadProductos }}
                    </h2>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-9">
              <label for="codigoProducto">Producto:</label>
              <input class="form-control input-lg" type="text" placeholder="Nombre o Codigo del Producto" id="codigoProducto" v-model="codigoProducto">
            </div>
            <div class="col-xs-12 col-sm-3">
              <label for="cantidadProducto">Cantidad:</label>
              <input id="cantidadProducto" class="form-control input-lg" type="text" placeholder="Cantidad" v-model="cantidadProducto" >
            </div>
          </div>

          <hr>

          <div class="text-right">
            <a href="#" class="btn btn-success">F2 - Cobrar</a>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    </div>

    <code>CTRL+BACKSPACE</code> Remueve de la venta al ultimo producto agregado
    <br>
    <code>ENTER</code> o <code>ESC</code> Llevar el puntero hacia ingresar producto
    <br>
    <code>F2</code> Iniciar cobranza
  </div>
</template>

<script>
  export default {
    props: [
      'venta_id', 'api'
    ],
    data() {
      return {
        codigoProducto:'',
        cantidadProducto:1,
        terminalLoading: true,
        resumen: {
          detalles: []
        }
      };
    },
    mounted() {
      this.terminalFocus();
      this.loadVenta();
    },
    methods: {
      removerUltimoProducto() {
        let lastId = this.resumen.detalles[this.resumen.detalles.length - 1].id;
        this.removerProducto(lastId);
      },
      iniciarCobranza() {
        this.$notify({
          message: "Opcion aun no disponible",
          type: 'error'
        });
      },
      removerProducto(id)
      {
        let uri = this.api+'/remove/'+id;
        axios.get(uri).then(response => {

          if(response.data.error) {
            this.$notify({
              message: response.data.error,
              type: 'error'
            });
          } else {
            this.resumen = response.data.resumen;
          }
        }).catch(e => {
        let bodyMessage = e.response.data.message;

          this.$notify({
            message: bodyMessage,
            type: 'error'
          });
        });
      },
      agregarProducto()
      {
        if(this.codigoProducto!='')
        {
          let uri = this.api+'/add/'+this.venta_id+'/'+this.cantidadProducto+'/'+this.codigoProducto;
          axios.get(uri).then(response => {

          if(response.data.error) {
            this.$notify({
              message: response.data.error,
              type: 'error'
            });

          } else {
            this.resumen = response.data.resumen;
          }

            this.codigoProducto = '';
            this.cantidadProducto= 1;

            this.terminalFocus();
          }).catch(e => {
            let bodyMessage = e.response.data.message;

            this.$notify({
              message: bodyMessage,
              type: 'error'
            });
          });
        }
      },
      loadVenta()
      {
        let uri = this.api+'/resumen/'+this.venta_id;
        axios.get(uri).then(response => {
          this.resumen = response.data.resumen;

          this.terminalLoading = false;

        }).catch(e => {
            let bodyMessage = e.response.data.message;

            this.$notify({
              message: bodyMessage,
              type: 'error'
            });

          this.terminalLoading = false;

        });
      },
      terminalFocus() {
        this.codigoProducto = '';
        this.cantidadProducto= 1;

        $("#codigoProducto").focus();
      }
    },
    computed: {
      keymap () {
        return {
          'esc': {
            keydown: this.terminalFocus
          },
          'ctrl+backspace': {
            keydown: this.removerUltimoProducto
          },
          'enter': {
            keydown: this.agregarProducto
          },
          'F2': {
            keydown: this.iniciarCobranza
          }
        }
      }
    }
  }
</script>