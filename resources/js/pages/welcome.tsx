import { Container } from '@/components/Container';
import { Header } from '@/components/Header';
import { NewPuppyForm } from '@/components/NewPuppyForm';
import { PageWrapper } from '@/components/PageWrapper';
import { PuppiesList } from '@/components/PuppiesList';
import { Search } from '@/components/Search';
import { Shortlist } from '@/components/ShortList';
import { useState } from 'react';

import { ApiError, Puppy } from '@/types';

export default function App({ puppies }: { puppies: Puppy[] }) {
    return (
        <PageWrapper>
            <Container>
                <Header />
                <Main pups={puppies} />
            </Container>
        </PageWrapper>
    );
}

function Main({ pups }: { pups: Puppy[] }) {
    const [searchQuery, setSearchQuery] = useState<string>('');
    const [puppies, setPuppies] = useState<Puppy[]>(pups);

    return (
        <main>
            <div className="mt-24 grid gap-8 sm:grid-cols-2">
                <Search
                    searchQuery={searchQuery}
                    setSearchQuery={setSearchQuery}
                />
                <Shortlist puppies={puppies} setPuppies={setPuppies} />
            </div>
            <PuppiesList
                searchQuery={searchQuery}
                puppies={puppies}
                setPuppies={setPuppies}
            />
            <NewPuppyForm puppies={puppies} setPuppies={setPuppies} />
        </main>
    );
}

function ErrorBox({ error }: { error: ApiError }) {
    return (
        <div className="mt-12 overflow-auto bg-red-100 p-6 shadow ring ring-black/5">
            <p className="text-red-500">
                {error.code}: {error.message}: {error.details}
            </p>
        </div>
    );
}
