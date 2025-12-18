import { like } from '@/actions/App/Http/Controllers/PuppyController';
import { Form } from '@inertiajs/react';
import { useLaravelReactI18n } from 'laravel-react-internationalization';
import { Heart, LoaderCircle, X } from 'lucide-react';
import { Puppy } from '../types';

export function Shortlist({ puppies }: { puppies: Puppy[] }) {
  const { t } = useLaravelReactI18n();
  const firstFivePuppies = puppies.slice(0, 5);
  const extraPuppiesCount = puppies.length - firstFivePuppies.length;
  return (
    <div>
      <h2 className="flex items-center gap-2 font-medium">
        <span>{t('Your shortlist')}</span>
        <Heart className="size-6 fill-pink-500 stroke-pink-500" />
      </h2>
      <ul className="mt-4 flex flex-wrap gap-4">
        {firstFivePuppies.map((puppy) => (
          <li
            key={puppy.id}
            className="relative flex items-center overflow-clip rounded-md bg-white shadow-sm ring ring-black/5 transition duration-100 starting:scale-0 starting:opacity-0"
          >
            <img
              height={32}
              width={32}
              alt={puppy.name}
              className="aspect-square w-8 object-cover"
              src={puppy.imageUrl}
            />
            <p className="px-3 text-sm text-slate-800">{puppy.name}</p>
            <DeleteButton id={puppy.id} />
          </li>
        ))}

        {extraPuppiesCount > 0 && (
          <li className="self-center text-sm text-slate-800">
            + {`${extraPuppiesCount} ${t('More')}`}
          </li>
        )}
      </ul>
    </div>
  );
}

function DeleteButton({ id }: { id: Puppy['id'] }) {
  return (
    <Form
      {...like.form(id)}
      options={{ preserveScroll: true }}
      className="h-full"
    >
      {({ processing }) => (
        <button
          type="submit"
          disabled={processing}
          className="group h-full border-l border-slate-100 px-2 hover:bg-slate-100"
        >
          {processing ? (
            <LoaderCircle className="size-4 animate-spin stroke-slate-300" />
          ) : (
            <X className="size-4 stroke-slate-400 group-hover:stroke-red-400" />
          )}
        </button>
      )}
    </Form>
  );
}
