<script lang="ts">
    import ButtonList from "../Buttons/ButtonList.svelte";
    import Form from "../Forms/Form.svelte";
</script>

<section class="section section--home section--news">
    <div class="section__inner section__inner--news">
        <div class="news news--recent">
            <sidebar class="news__column news__column--sidebar">
                <h2 class="news__title-sidebar" aria-label="Consultar datos">
                    Consultar datos
                </h2>

                <section class="news__articles">
                    <article class="news__article">
                        <Form>
                            {#snippet content()}
                                <div class="form__inner">
                                    <div class="form__item">
                                        <span>Tipo de documento:</span>
                                        <ButtonList
                                            name="document-type"
                                            required={true}
                                            label="Selecione una base de datos..."
                                            list={[
                                                {
                                                    label: "Cédula de Identidad",
                                                    value: "ci",
                                                },
                                                {
                                                    label: "Cédula de Extranjería",
                                                    value: "ce",
                                                },
                                                {
                                                    label: "Pasaporte",
                                                    value: "pasaporte",
                                                },
                                            ]}
                                        />
                                    </div>

                                    <label for="document" class="form__label">
                                        <span>Número de documento:</span>
                                        <input
                                            type="text"
                                            name="document-number"
                                            id="document"
                                            placeholder="Por ejemplo, 123456789"
                                            class="form__input"
                                        />
                                    </label>
                                </div>
                            {/snippet}
                        </Form>
                    </article>
                </section>
            </sidebar>

            <div class="news__column news__column--content">
                <h2 class="section__title section__title--news">
                    Resultados de la búsqueda
                </h2>

                <article class="news__content">
                    <div class="news__content-column">
                        <h2 class="news__title">Título de la noticia</h2>

                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Harum neque, facere architecto exercitationem
                            distinctio aliquid quam veniam assumenda fugit
                            commodi molestias nemo corrupti debitis sed
                            repellendus nisi, eaque blanditiis aut?
                        </p>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Eveniet earum numquam harum at illo, odit
                            neque quidem laudantium praesentium cum aperiam.
                            Ipsum dolores deserunt quod incidunt vero quasi
                            asperiores dolor.
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
