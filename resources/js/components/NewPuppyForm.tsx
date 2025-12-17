import { store } from '@/actions/App/Http/Controllers/PuppyController';
import { Form } from '@inertiajs/react';
import { useLaravelReactI18n } from 'laravel-react-internationalization';

export function NewPuppyForm() {
  const { t } = useLaravelReactI18n();

  return (
    <div className="mt-12 flex items-center justify-between bg-white p-8 shadow ring ring-black/5">
      <Form
        {...store.form()}
        className="mt-4 flex w-full flex-col items-start gap-4"
        options={{ preserveScroll: true }}
      >
        {({ processing, getFormData, errors }) => (
          <>
            <div className="grid w-full gap-6 md:grid-cols-3">
              <fieldset className="flex w-full flex-col gap-1">
                <label htmlFor="name">{t('Name')}</label>
                <input
                  className="max-w-96 rounded-sm bg-white px-2 py-1 ring ring-black/20 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                  id="name"
                  type="text"
                  name="name"
                />
                {errors.name && (
                  <p className="mt-1 text-xs text-red-500">{errors.name}</p>
                )}
              </fieldset>
              <fieldset className="flex w-full flex-col gap-1">
                <label htmlFor="trait">{t('Personality trait')}</label>
                <input
                  className="max-w-96 rounded-sm bg-white px-2 py-1 ring ring-black/20 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                  id="trait"
                  type="text"
                  name="trait"
                />
                {errors.trait && (
                  <p className="mt-1 text-xs text-red-500">{errors.trait}</p>
                )}
              </fieldset>
              <fieldset className="col-span-2 flex w-full flex-col gap-1">
                <label htmlFor="image">{t('Profile pic')}</label>
                <input
                  className="max-w-96 rounded-sm bg-white px-2 py-1 ring ring-black/20 focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                  id="image"
                  type="file"
                  name="image"
                />
                {errors.image && (
                  <p className="mt-1 text-xs text-red-500">{errors.image}</p>
                )}
              </fieldset>
            </div>
            <button
              type="submit"
              className="mt-4 inline-block rounded bg-cyan-300 px-4 py-2 font-medium text-cyan-900 hover:bg-cyan-200 focus:ring-2 focus:ring-cyan-500 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-200"
              disabled={processing}
            >
              {processing
                ? `${t('Adding')} ${getFormData().get('name') || t('puppy')} ...`
                : t('Add :name', { name: t('puppy') })}
            </button>
          </>
        )}
      </Form>
    </div>
  );
}
