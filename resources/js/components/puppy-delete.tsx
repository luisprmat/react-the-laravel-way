import { destroy } from '@/actions/App/Http/Controllers/PuppyController';
import {
  AlertDialog,
  AlertDialogAction,
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
import { useLaravelReactI18n } from 'laravel-react-internationalization';
import { TrashIcon } from 'lucide-react';

export function PuppyDelete({ puppy }: { puppy: Puppy }) {
  const { t } = useLaravelReactI18n();

  return (
    <div>
      <AlertDialog>
        <AlertDialogTrigger asChild>
          <Button
            size="icon"
            variant="destructive"
            aria-label={t('Delete :name', { name: t('puppy') })}
          >
            <TrashIcon className="size-4" />
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
                <AlertDialogAction type="submit">
                  {t('Delete to :name', { name: puppy.name })}
                </AlertDialogAction>
              </AlertDialogFooter>
            )}
          </Form>
        </AlertDialogContent>
      </AlertDialog>
    </div>
  );
}
