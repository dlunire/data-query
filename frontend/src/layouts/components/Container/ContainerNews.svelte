<script lang="ts">
    import IconSearchRegister from "../../icons/IconSearchRegister.svelte";
    import ButtonList from "../Buttons/ButtonList.svelte";
    import Form from "../Forms/Form.svelte";

    let document: boolean = true;

    function setDocument(): void {
        document = true;
    }

    function unsetDocument(): void {
        document = false;
    }
</script>

<section class="section section--home section--news">
    <div class="section__inner section__inner--news">
        <div class="news news--recent">
            <sidebar class="news__column news__column--sidebar">
                <h2 class="news__title-sidebar" aria-label="Consultar datos">
                    Consultar datos
                </h2>

                <nav class="tabs">
                    <button
                        class="button button--tab"
                        aria-label="Número de documento"
                        onclick={setDocument}
                        class:selected={document}
                    >
                        <span>Documento</span>
                    </button>

                    <button
                        class="button button--tab"
                        aria-label="Por nombres"
                        onclick={unsetDocument}
                        class:selected={!document}
                    >
                        <span>Nombres</span>
                    </button>
                </nav>

                <section class="news__articles">
                    <article class="news__article">
                        {#if document}
                            <h3 class="news__subtitle-sidebar">
                                Buscar por cédula
                            </h3>

                            <Form action="/api/v1/register" method="GET">
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

                                        <label
                                            for="document"
                                            class="form__label"
                                        >
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

                                    <div
                                        class="form__buttons form__buttons--sidebar"
                                    >
                                        <button
                                            class="button button--primary"
                                            aria-label="Buscar"
                                        >
                                            <IconSearchRegister />
                                            <span>Buscar por cédula</span>
                                        </button>
                                    </div>

                                    <input type="hidden" name="is-document" value="true" />
                                {/snippet}
                            </Form>
                        {/if}

                        {#if !document}
                            <h3 class="news__subtitle-sidebar">
                                Buscar por nombres
                            </h3>

                            <Form>
                                {#snippet content()}
                                    <div class="form__inner">
                                        <label
                                            for="first-name"
                                            class="form__label"
                                        >
                                            <span
                                                >Primer nombre (opcional):</span
                                            >
                                            <input
                                                type="text"
                                                name="first-name"
                                                id="first-name"
                                                placeholder="Por ejemplo, Arnold"
                                                class="form__input"
                                            />
                                        </label>

                                        <label
                                            for="second-name"
                                            class="form__label"
                                        >
                                            <span
                                                >Segundo nombre (opcional):</span
                                            >
                                            <input
                                                type="text"
                                                name="second-name"
                                                id="second-name"
                                                placeholder="Por ejemplo, Josue"
                                                class="form__input"
                                            />
                                        </label>

                                        <label
                                            for="first-surname"
                                            class="form__label"
                                        >
                                            <span
                                                >Primer apellido (opcional):</span
                                            >
                                            <input
                                                type="text"
                                                name="first-surname"
                                                id="first-surname"
                                                placeholder="Por ejemplo, Clinton"
                                                class="form__input"
                                            />
                                        </label>

                                        <label
                                            for="second-surname"
                                            class="form__label"
                                        >
                                            <span
                                                >Segundo apellido (opcional):</span
                                            >
                                            <input
                                                type="text"
                                                name="second-surname"
                                                id="second-surname"
                                                placeholder="Por ejemplo, Ramírez"
                                                class="form__input"
                                            />
                                        </label>
                                    </div>

                                    <div
                                        class="form__buttons form__buttons--sidebar"
                                    >
                                        <button
                                            class="button button--primary"
                                            aria-label="Buscar"
                                        >
                                            <IconSearchRegister />
                                            <span>Buscar por nombres</span>
                                        </button>
                                    </div>
                                {/snippet}
                            </Form>
                        {/if}
                    </article>
                </section>
            </sidebar>

            <div class="news__column news__column--content">
                <h2 class="section__title section__title--news">
                    Resultados de la búsqueda
                </h2>

                <article class="news__content">
                    <div class="news__column news__column--content">
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

<style lang="scss">
    .selected {
        --text-color: #003a61;
        border-color: var(--text-color);

        &:hover {
            background-color: white;
        }

        &::before {
            --border-color: #005c99;
            pointer-events: none;
        }
    }
</style>