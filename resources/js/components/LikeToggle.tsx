import { like } from '@/routes/puppies';
import { Form, usePage } from '@inertiajs/react';
import clsx from 'clsx';
import { Heart, LoaderCircle } from 'lucide-react';
import { Puppy, SharedData } from '../types';

export function LikeToggle({ puppy }: { puppy: Puppy }) {
  const { auth } = usePage<SharedData>().props;

  return (
    <Form {...like.form(puppy)} options={{ preserveScroll: true }}>
      {({ processing }) => (
        <button
          type="submit"
          className="group disabled:cursor-not-allowed"
          disabled={!auth.user || processing}
        >
          {processing ? (
            <LoaderCircle className="animate-spin stroke-slate-300" />
          ) : (
            <Heart
              className={clsx(
                auth.user && puppy.likedBy.includes(auth.user.id)
                  ? 'fill-pink-500 stroke-none'
                  : 'stroke-slate-200 group-hover:stroke-slate-300',
              )}
            />
          )}
        </button>
      )}
    </Form>
  );
}
