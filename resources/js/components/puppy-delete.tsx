import { destroy } from '@/actions/App/Http/Controllers/PuppyController';
import {
  AlertDialog,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { Puppy } from '@/types';
import { Form } from '@inertiajs/react';
import clsx from 'clsx';
import { useLaravelReactI18n } from 'laravel-react-internationalization';
import { LoaderCircle, TrashIcon } from 'lucide-react';
import { useState } from 'react';

export function PuppyDelete({ puppy }: { puppy: Puppy }) {
  const { t } = useLaravelReactI18n();
  const [open, setOpen] = useState(false);

  return (
    <div>
      <AlertDialog open={open} onOpenChange={setOpen}>
        <AlertDialogTrigger asChild>
          <Button
            className="group/delete bg-background/50 hover:bg-background"
            size="icon"
            variant="secondary"
            aria-label={t('Delete :name', { name: t('puppy') })}
          >
            <TrashIcon className="size-4 group-hover/delete:stroke-destructive" />
          </Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>{t('Are you absolutely sure?')}</AlertDialogTitle>
            <AlertDialogDescription>
              {t(
                'Who in their right mind would delete such a cute puppy? Seriously?',
              )}
            </AlertDialogDescription>
          </AlertDialogHeader>
          <Form {...destroy.form(puppy)} options={{ preserveScroll: true }}>
            {({ processing }) => (
              <AlertDialogFooter>
                <AlertDialogCancel>{t('Cancel')}</AlertDialogCancel>
                <Button
                  className="relative disabled:opacity-100"
                  disabled={processing}
                  type="submit"
                >
                  {processing && (
                    <div className="absolute inset-0 grid place-items-center">
                      <LoaderCircle className="size-5 animate-spin stroke-primary-foreground" />
                    </div>
                  )}
                  <span className={clsx(processing && 'invisible')}>
                    {t('Delete to :name', { name: puppy.name })}
                  </span>
                </Button>
              </AlertDialogFooter>
            )}
          </Form>
        </AlertDialogContent>
      </AlertDialog>
    </div>
  );
}
