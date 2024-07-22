
<section id="buscador-site" class="parallax-window">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-7 mx-auto">
                <div class="container--search-box">
                    <h2 class="site-title"><a href="index.php?langSite=es&page=view_biblioteca_digital"><img src="https://i.ibb.co/hfvF1C0/logobiblioteca-digital.png" alt="logobiblioteca-digital" border="0" width="200"></a></h2>

                    <div class="form-row">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" placeholder="Escribe aquí" name="busca_palabra" id="busca_palabra">
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="custom-select" name="buscador_tipo" id="buscador_tipo">
                                <option selected disabled value="">Seleccione una secci&oacute;n</option>
                                <option value="Didactico">Recursos did&aacute;cticos</option>
                                <option value="Documentos">Documentos</option>
                                <option value="Multimedia">Videos</option>
                                <option value="Libros@">Libros</option>
                                <option value="Dossier">Dossier</option>
                                <option value="Foco">Bolet&iacute;n en Foco</option>
                                <option value="Ideas">Boletín Ideas</option>
                                <option value="@Libros">ARPA Libros</option>
                                <option value="Problemas">ARPA Problemas</option>
                                <option value="Sets">ARPA Sets aleatorios</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" name="busca_Autor" id="busca_Autor" placeholder="Ingresar Autor">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" name="busca_Anno" id="busca_Anno" placeholder="Ingresar a&ntilde;o">
                        </div>
                        <div class="col-12 col-md-2 ">
                            <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="5">
                            <button type="submit" id="btn-submit" class="btn btn-primary btn-block" formaction="javascript:buscadorFormularioRecursos();">Buscar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
