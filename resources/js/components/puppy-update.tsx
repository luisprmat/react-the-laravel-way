import { update } from '@/actions/App/Http/Controllers/PuppyController';
import { Button } from '@/components/ui/button';
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog';
import { Puppy } from '@/types';
import { Form } from '@inertiajs/react';
import clsx from 'clsx';
import { useLaravelReactI18n } from 'laravel-react-internationalization';
import { EditIcon, LoaderCircle } from 'lucide-react';
import { useState } from 'react';
import { Input } from './ui/input';
import { Label } from './ui/label';

export function PuppyUpdate({ puppy }: { puppy: Puppy }) {
  const { t } = useLaravelReactI18n();
  const [open, setOpen] = useState(false);

  return (
    <div>
      <Dialog open={open} onOpenChange={setOpen}>
        <DialogTrigger asChild>
          <Button
            className="group/update bg-background/50 hover:bg-background"
            size="icon"
            variant="secondary"
            aria-label={t('Update :name', { name: t('puppy') })}
          >
            <EditIcon className="size-4" />
          </Button>
        </DialogTrigger>
        <DialogContent>
          <DialogTitle>{t('Edit :name', { name: puppy.name })}</DialogTitle>
          <DialogDescription>
            {t('Make changes to your puppy’s information below.')}
          </DialogDescription>
          <Form
            {...update.form(puppy)}
            className="space-y-6"
            options={{ preserveScroll: true }}
            onSuccess={() => setOpen(false)}
          >
            {({ processing, errors }) => (
              <>
                <fieldset>
                  <Label htmlFor="name">{t('Name')}</Label>
                  <Input
                    id="name"
                    className="mt-1 block w-full"
                    required
                    type="text"
                    autoComplete="name"
                    name="name"
                    defaultValue={puppy.name}
                    placeholder={t("Puppy's name")}
                  />
                  {errors.name && (
                    <p className="mt-1 text-xs text-red-500">{errors.name}</p>
                  )}
                </fieldset>

                <fieldset>
                  <Label htmlFor="trait">{t('Personality trait')}</Label>
                  <Input
                    id="trait"
                    className="mt-1 block w-full"
                    required
                    type="text"
                    name="trait"
                    defaultValue={puppy.trait}
                    placeholder={t('Personality trait')}
                  />
                  {errors.trait && (
                    <p className="mt-1 text-xs text-red-500">{errors.trait}</p>
                  )}
                </fieldset>

                <fieldset>
                  <Label htmlFor="image">{t('Change Image')}</Label>
                  <Input
                    id="image"
                    className="mt-1 block w-full"
                    type="file"
                    name="image"
                    placeholder={t('Profile pic')}
                  />
                  {errors.image && (
                    <p className="mt-1 text-xs text-red-500">{errors.image}</p>
                  )}
                </fieldset>

                <DialogFooter className="gap-2">
                  <DialogClose asChild>
                    <Button variant="secondary">{t('Cancel')}</Button>
                  </DialogClose>
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
                      {t('Update')}
                    </span>
                  </Button>
                </DialogFooter>
              </>
            )}
          </Form>
        </DialogContent>
      </Dialog>
    </div>
  );
}
